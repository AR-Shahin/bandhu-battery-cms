<?php

namespace App\Http\Controllers\Admin;

use Exception;
use App\Models\Contact;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use ZipArchive;
use Symfony\Component\HttpFoundation\StreamedResponse;
use App\Jobs\CreateStorageZipJob;

class DashboardController extends Controller
{
    function index()  {
        $message = Contact::whereStatus(0)->count();
        $product = Product::count();
        return view("admin.dashboard",compact("message","product"));
    }

    function backup() {
        // $exitCode = Artisan::call("backup:run");
        // $response = Artisan::output();
        // dd($response);
        try{
            $directoryPath = storage_path("app/Laravel");


        $zipFiles = File::glob("$directoryPath/*.zip");
        foreach ($zipFiles as $zipFile) {

            $filename = pathinfo($zipFile, PATHINFO_FILENAME);

            $zipFileContents = Storage::get("Laravel/{$filename}.zip");

            unlink($zipFile);
        }

        $exitCode = Artisan::call("backup:run");
        if($exitCode != 0){
            dd($exitCode);
            $this->errorAlert("Error!");
            return back();
        }else{
            $zipFiles = File::glob("$directoryPath/*.zip");

            if($zipFiles){
                return response()->download($zipFiles[0]);
            }else{

                $this->warningAlert("Something went wrong!");
                return back();
            }
        }

        }catch(Exception $e){
            Log::info("Backup Error " . $e->getMessage());
            dd($e->getMessage());
        }

    }

    function downloadStorageFiles(Request $request)
    {
        try {
            $storageAppPath = storage_path('app');
            
            // Check if storage/app directory exists
            if (!File::exists($storageAppPath)) {
                return back()->with('error', 'Storage directory not found!');
            }

            // Calculate total size and file count for warning
            $files = File::allFiles($storageAppPath);
            $totalSize = 0;
            $fileCount = 0;
            
            foreach ($files as $file) {
                $relativePath = $file->getRelativePathname();
                if (strpos($relativePath, 'temp/') !== 0) {
                    $totalSize += $file->getSize();
                    $fileCount++;
                }
            }
            
            $sizeInGB = $totalSize / (1024 * 1024 * 1024);
            
            // For extremely large files (>10GB), use streaming approach
            if ($sizeInGB > 10) {
                return $this->streamLargeZipDownload($files, $storageAppPath, $totalSize, $fileCount);
            }
            
            // For moderately large files (>5GB), warn user
            if ($sizeInGB > 5 && !$request->has('confirmed')) {
                return back()->with('warning', 
                    "Warning: You are about to download {$fileCount} files totaling " . 
                    number_format($sizeInGB, 2) . "GB. This may take a very long time. " .
                    "Add ?confirmed=1 to proceed."
                );
            }

            return $this->createAndDownloadZip($files, $storageAppPath, $fileCount, $sizeInGB);
            
        } catch (Exception $e) {
            Log::error('Storage download error: ' . $e->getMessage());
            return back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    
    private function createAndDownloadZip($files, $storageAppPath, $fileCount, $sizeInGB)
    {
        // Set memory and time limits
        ini_set('memory_limit', '2G');
        set_time_limit(0);
        
        $zipFileName = 'storage_files_' . date('Y-m-d_H-i-s') . '.zip';
        $zipFilePath = storage_path('app/temp/' . $zipFileName);
        
        // Ensure temp directory exists
        $tempDir = dirname($zipFilePath);
        if (!File::exists($tempDir)) {
            File::makeDirectory($tempDir, 0755, true);
        }

        $zip = new ZipArchive();
        
        if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
            throw new Exception('Could not create zip file!');
        }

        $processedFiles = 0;
        foreach ($files as $file) {
            $filePath = $file->getRealPath();
            $relativePath = $file->getRelativePathname();
            
            if (strpos($relativePath, 'temp/') !== 0) {
                $zip->addFile($filePath, $relativePath);
                $processedFiles++;
                
                // Flush output periodically
                if ($processedFiles % 50 === 0) {
                    if (ob_get_level()) {
                        ob_flush();
                        flush();
                    }
                }
            }
        }

        $zip->close();
        
        Log::info("Storage files download: {$fileCount} files, " . number_format($sizeInGB, 2) . "GB");

        return response()->download($zipFilePath, $zipFileName)->deleteFileAfterSend(true);
    }
    
    private function streamLargeZipDownload($files, $storageAppPath, $totalSize, $fileCount)
    {
        $zipFileName = 'storage_files_' . date('Y-m-d_H-i-s') . '.zip';
        
        Log::info("Starting streaming download for large files: {$fileCount} files, " . 
                  number_format($totalSize / (1024 * 1024 * 1024), 2) . "GB");
        
        return new StreamedResponse(function() use ($files, $storageAppPath, $zipFileName) {
            // Set unlimited execution time and high memory
            set_time_limit(0);
            ini_set('memory_limit', '4G');
            
            // Create a temporary file for the zip
            $tempZipPath = storage_path('app/temp/' . $zipFileName);
            
            // Ensure temp directory exists
            $tempDir = dirname($tempZipPath);
            if (!File::exists($tempDir)) {
                File::makeDirectory($tempDir, 0755, true);
            }
            
            $zip = new ZipArchive();
            if ($zip->open($tempZipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
                throw new Exception('Could not create zip file for streaming!');
            }

            // Add files in batches to avoid memory issues
            $batchSize = 20; // Process 20 files at a time
            $processedFiles = 0;
            $validFiles = [];
            
            // Filter valid files first
            foreach ($files as $file) {
                $relativePath = $file->getRelativePathname();
                if (strpos($relativePath, 'temp/') !== 0) {
                    $validFiles[] = $file;
                }
            }
            
            $totalFiles = count($validFiles);
            $batches = array_chunk($validFiles, $batchSize);
            
            foreach ($batches as $batch) {
                foreach ($batch as $file) {
                    $filePath = $file->getRealPath();
                    $relativePath = $file->getRelativePathname();
                    $zip->addFile($filePath, $relativePath);
                    $processedFiles++;
                }
                
                // Flush and give some feedback
                if (ob_get_level()) {
                    ob_flush();
                    flush();
                }
                
                // Small delay to prevent overwhelming the system
                usleep(10000); // 10ms delay
            }
            
            $zip->close();
            
            // Stream the file in chunks
            $handle = fopen($tempZipPath, 'rb');
            if ($handle === false) {
                throw new Exception('Could not open zip file for streaming!');
            }
            
            while (!feof($handle)) {
                $chunk = fread($handle, 8192); // 8KB chunks
                echo $chunk;
                if (ob_get_level()) {
                    ob_flush();
                    flush();
                }
            }
            
            fclose($handle);
            
            // Clean up the temporary file
            if (File::exists($tempZipPath)) {
                File::delete($tempZipPath);
            }
            
        }, 200, [
            'Content-Type' => 'application/zip',
            'Content-Disposition' => 'attachment; filename="' . $zipFileName . '"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0'
        ]);
    }
    
    function createStorageZipBackground(Request $request)
    {
        try {
            // Get admin email (assuming you have auth)
            $adminEmail = auth('admin')->user()->email ?? 'admin@example.com';
            
            // Dispatch the background job
            CreateStorageZipJob::dispatch($adminEmail);
            
            return back()->with('success', 
                'Large file ZIP creation started in background. Check the "Download Ready Files" section below in a few minutes.'
            );
            
        } catch (Exception $e) {
            Log::error('Background job dispatch error: ' . $e->getMessage());
            return back()->with('error', 'Failed to start background process: ' . $e->getMessage());
        }
    }
    
    function checkDownloadStatus()
    {
        try {
            $downloadsDir = storage_path('app/downloads');
            
            if (!File::exists($downloadsDir)) {
                return response()->json(['status' => 'no_downloads', 'message' => 'No downloads available']);
            }
            
            $zipFiles = File::glob($downloadsDir . '/*.zip');
            $availableDownloads = [];
            
            foreach ($zipFiles as $zipFile) {
                $fileName = basename($zipFile);
                $fileSize = File::size($zipFile);
                $createdAt = File::lastModified($zipFile);
                
                $availableDownloads[] = [
                    'filename' => $fileName,
                    'size' => $this->formatBytes($fileSize),
                    'created_at' => date('Y-m-d H:i:s', $createdAt),
                    'download_url' => route('admin.download_ready_file', ['filename' => $fileName])
                ];
            }
            
            return response()->json([
                'status' => 'success',
                'downloads' => $availableDownloads
            ]);
            
        } catch (Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
    
    function downloadReadyFile($filename)
    {
        try {
            // Sanitize filename to prevent directory traversal
            $filename = basename($filename);
            $filePath = storage_path('app/downloads/' . $filename);
            
            if (!File::exists($filePath) || !str_ends_with($filename, '.zip')) {
                return back()->with('error', 'File not found or invalid file type!');
            }
            
            // Download and then delete the file
            return response()->download($filePath, $filename)->deleteFileAfterSend(true);
            
        } catch (Exception $e) {
            Log::error('Ready file download error: ' . $e->getMessage());
            return back()->with('error', 'Download failed: ' . $e->getMessage());
        }
    }
    
    private function formatBytes($size, $precision = 2)
    {
        if ($size == 0) return '0 B';
        $base = log($size, 1024);
        $suffixes = ['B', 'KB', 'MB', 'GB', 'TB'];
        return round(pow(1024, $base - floor($base)), $precision) . ' ' . $suffixes[floor($base)];
    }
    
}
