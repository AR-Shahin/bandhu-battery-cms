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

    
}
