<?php

namespace App\Jobs;

use Exception;
use ZipArchive;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class CreateStorageZipJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $timeout = 3600; // 1 hour timeout
    public $tries = 1; // Only try once
    
    protected $adminEmail;
    protected $zipFileName;

    public function __construct($adminEmail)
    {
        $this->adminEmail = $adminEmail;
        $this->zipFileName = 'storage_files_' . date('Y-m-d_H-i-s') . '.zip';
    }

    public function handle()
    {
        try {
            // Set high memory and unlimited time
            ini_set('memory_limit', '4G');
            set_time_limit(0);
            
            $storageAppPath = storage_path('app');
            $files = File::allFiles($storageAppPath);
            
            // Create zip file in a downloads directory
            $downloadsDir = storage_path('app/downloads');
            if (!File::exists($downloadsDir)) {
                File::makeDirectory($downloadsDir, 0755, true);
            }
            
            $zipFilePath = $downloadsDir . '/' . $this->zipFileName;
            
            $zip = new ZipArchive();
            if ($zip->open($zipFilePath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== TRUE) {
                throw new Exception('Could not create zip file in background job!');
            }

            $processedFiles = 0;
            $totalFiles = 0;
            
            foreach ($files as $file) {
                $relativePath = $file->getRelativePathname();
                
                // Skip temp and downloads directories
                if (strpos($relativePath, 'temp/') !== 0 && strpos($relativePath, 'downloads/') !== 0) {
                    $zip->addFile($file->getRealPath(), $relativePath);
                    $processedFiles++;
                    $totalFiles++;
                    
                    // Log progress every 1000 files
                    if ($processedFiles % 1000 === 0) {
                        Log::info("Background ZIP progress: {$processedFiles} files processed");
                    }
                }
            }

            $zip->close();
            
            // Store file info for later retrieval
            $fileInfo = [
                'filename' => $this->zipFileName,
                'path' => $zipFilePath,
                'created_at' => now(),
                'file_count' => $totalFiles,
                'admin_email' => $this->adminEmail
            ];
            
            Storage::put('downloads/file_info.json', json_encode($fileInfo));
            
            Log::info("Background ZIP creation completed: {$totalFiles} files, " . 
                     number_format(File::size($zipFilePath) / (1024 * 1024 * 1024), 2) . "GB");
            
        } catch (Exception $e) {
            Log::error('Background ZIP creation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    public function failed(Exception $exception)
    {
        Log::error('CreateStorageZipJob failed: ' . $exception->getMessage());
    }
}
