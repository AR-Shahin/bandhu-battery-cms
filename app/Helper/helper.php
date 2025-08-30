<?php

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Helper\File\File as FileFile;
use Illuminate\Support\Facades\File;


function removeNullDataFromArray($data) {
    return array_filter($data ?? [], function($filter){
        return ! empty($filter);
    });
}

function bn_slug($string) {
    return preg_replace('/\s+/u', '-', trim($string));
}

function show_text($text,$word = 20)  {
    return Str::words($text, $word, '...');
}


function show_in_html($txt,$word = 20)  {
    $description = strip_tags($txt); // Remove HTML tags if needed
    $words = explode(' ', $description); // Split the string into words
        $limitedWords = array_slice($words, 0, $word); // Get the first 10 words
    return $shortDescription = implode(' ', $limitedWords);
}

function generateSelectOption($data) {
    $html = '<option>Select An Item</option>';
    foreach($data as $item){
        $html.= '<option value="'. $item->id .'">'. $item->name .'</option>';
    }
    return $html;
}

function database_backup()
{
    $backupDir = storage_path('backups');
    if (!is_dir($backupDir)) {
        mkdir($backupDir, 0777, true);
    }
    $directoryPath = storage_path("backups");
    $oldSQLFiles = File::glob("$directoryPath/*.sql");
    foreach ($oldSQLFiles as $file) {
        FileFile::deleteFile($file);
    }

    $timestamp = Carbon::now()->format('Y-m-d_H-i-s');
    $backupFile = "{$backupDir}/backup_{$timestamp}.sql";
    $tables = DB::select('SHOW TABLES');
    $tableKey = key((array)$tables[0]);

    $file = fopen($backupFile, 'w');

    foreach ($tables as $table) {
        $tableName = $table->{$tableKey};

        // Get CREATE TABLE statement
        $createTable = DB::select("SHOW CREATE TABLE {$tableName}")[0]->{'Create Table'};

        // Write CREATE TABLE statement to the backup file
        fwrite($file, $createTable . ";\n\n");

        // Get table data
        $data = DB::select("SELECT * FROM {$tableName}");

        if (count($data)) {
            // Insert data into backup file
            foreach ($data as $row) {
                $rowData = array_values((array)$row);
                $rowData = array_map(fn ($val) => is_null($val) ? 'NULL' : "'" . addslashes($val) . "'", $rowData);
                $rowDataStr = implode(', ', $rowData);
                fwrite($file, "INSERT INTO {$tableName} VALUES ({$rowDataStr});\n");
            }

            fwrite($file, "\n");
        }
    }

    fclose($file);

    return response()->download($backupFile);
}

 function backup_with_file() {
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
