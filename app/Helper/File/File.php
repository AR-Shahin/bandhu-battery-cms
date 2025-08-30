<?php

namespace App\Helper\File;

use Illuminate\Support\Facades\Storage;

class File
{

    public static function upload($file, $path)
    {
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
        Storage::putFileAs("public/$path", $file, $fileName);

        return "storage/$path/" . $fileName;
    }
    public static function uploadWithName($file, $path)
    {
        $fileName = time() . '_' . $file->getClientOriginalName();
        Storage::putFileAs("public/$path", $file, $fileName);

        return "storage/$path/" . $fileName;
    }

    static function uploadBase64Image($imageData,$path) {
        $data = explode(',', $imageData);
        $imageData = base64_decode($data[1]);

        $mime = finfo_buffer(finfo_open(), $imageData, FILEINFO_MIME_TYPE);
        $extensions = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
        ];

        $extension = $extensions[$mime] ?? 'jpg';

        $filename = time() . uniqid() . '.' . $extension;

        $fullPath = $path . '/' . $filename;
        Storage::disk('public')->put($fullPath, $imageData);

        return $fullPath;
    }
    public static function deleteFile($file)
    {
        if (file_exists($file)) {
            unlink($file);
        }
    }

    static function uploadYearMonthWise($file,$folder) {
        $year = date("Y");
        $month = strtolower(date("F"));
        $day = date("d");

        $path = "$year/$month/$day";
        $fileName = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        $storage_path = storage_path();
        Storage::putFileAs("public/$path/$folder", $file, $fileName);
        shell_exec("chmod -R 755 " . $storage_path . "/*");
        return "storage/$path/$folder/" . $fileName;
    }
}
