<?php

use App\Http\Controllers\Admin\{
    AdminController,
    BrandController,
    CategoryController,
    ContactController,
    DashboardController,
    PermissionController,
    ProductController,
    RoleController,
    ServiceController,
    SingleContentController,
    SubCategoryController,
    UnitController,
    VideoGalleryController,
    WebsiteController
};;
use Illuminate\Support\Facades\Route;

Route::prefix("admin")->middleware("auth:admin")->name("admin.")->group(function(){
    Route::get("/dashboard",[DashboardController::class,"index"])->name("dashboard");
    Route::post("/backup",[DashboardController::class,"backup"])->name("backup");
    Route::post("/backup-db",fn() => database_backup())->name("backup_db");
    Route::post("/download-storage-files",[DashboardController::class,"downloadStorageFiles"])->name("download_storage_files");
    Route::post("/create-storage-zip-background",[DashboardController::class,"createStorageZipBackground"])->name("create_storage_zip_background");
    Route::get("/check-download-status",[DashboardController::class,"checkDownloadStatus"])->name("check_download_status");
    Route::get("/download-ready-file/{filename}",[DashboardController::class,"downloadReadyFile"])->name("download_ready_file");

    # Role
    Route::prefix('roles')->controller(RoleController::class)->name("roles.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/store/{role?}","storeAndUpdate")->name("store");
        Route::post("delete/{role}","delete")->name("delete");
        Route::get("assign-permissions/{role}","assignPermission")->name("assign_permission");
        Route::post("assign--permissions/{role}","assignPermissionStore")->name("assign__permission");
    });

      # Permission
      Route::prefix('permissions')->controller(PermissionController::class)->name("permissions.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("data_table","data_table")->name("data_table");
        Route::post("store/{permission?}","store")->name("store");
        Route::post("delete/{permission}","delete")->name("delete");
    });



      # Admin
      Route::prefix('admins')->controller(AdminController::class)->name("admins.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("/create","create")->name("create");
        Route::get("/edit/{admin}","edit")->name("edit");
        Route::get("data_table","data_table")->name("data_table");
        Route::post("store","store")->name("store");
        Route::post("update/{admin?}","update")->name("update");
        Route::post("delete/{admin}","delete")->name("delete");
    });


    # Service
    Route::prefix('services')->controller(ServiceController::class)->name("services.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("/create","create")->name("create");
        Route::get("/edit/{service}","edit")->name("edit");
        Route::post("store","store")->name("store");
        Route::post("update/{service}","update")->name("update");
        Route::post("delete/{service}","delete")->name("delete");
    });

    # Single Content
    Route::prefix('single-content')->controller(SingleContentController::class)->name("single-content.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/update/{data}","update")->name("update");
    });

   # Website
    Route::prefix('website')->controller(WebsiteController::class)->name("website.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/update/{data}","update")->name("update");
    });


    # Contact
    Route::prefix('contacts')->controller(ContactController::class)->name("contacts.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("/update/{contact}","update")->name("update");
        Route::post("delete/{contact}","delete")->name("delete");
    });

    # Category
    Route::prefix('category')->controller(CategoryController::class)->name("category.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/delete/{category:id}","delete")->name("delete");
        Route::post("store","store")->name("store");
        Route::post("/update/{category:slug}","update")->name("update");
    });

    # Sub Category
    Route::prefix('sub-category')->controller(SubCategoryController::class)->name("sub-category.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/delete/{category:id}","delete")->name("delete");
        Route::post("store","store")->name("store");
        Route::post("/update/{category:slug}","update")->name("update");

    });

    # Brand
    Route::prefix('brand')->controller(BrandController::class)->name("brand.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/delete/{brand:id}","delete")->name("delete");
        Route::post("store","store")->name("store");
        Route::post("/update/{brand:slug}","update")->name("update");
    });


    # Product
    Route::prefix('products')->controller(ProductController::class)->name("product.")->group(function () {
        Route::get("","index")->name("index");
        Route::get("/create","create")->name("create");
        Route::get("/edit/{product}","edit")->name("edit");
        Route::get("/view/{product}","view")->name("view");
        Route::post("store","store")->name("store");
        Route::post("update/{product}","update")->name("update");
        Route::post("delete/{product}","delete")->name("delete");
        Route::post("photo_gallery/{image}","photoGalleryUpdate")->name("photo_gallery");
        Route::post("video_gallery/{video}","videoGalleryUpdate")->name("video_gallery");
        Route::post("gallery_extra/{product}","extraGalleryImageStore")->name("gallery_extra");
    });

    # Video Gallery
    Route::prefix('video-gallery')->controller(VideoGalleryController::class)->name("video-gallery.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/delete/{videoGallery:id}","delete")->name("delete");
        Route::post("store","store")->name("store");
        Route::post("/update/{videoGallery:id}","update")->name("update");
    });

    # Unit
    Route::prefix('unit')->controller(UnitController::class)->name("unit.")->group(function () {
        Route::get("","index")->name("index");
        Route::post("/delete/{unit:id}","delete")->name("delete");
        Route::post("store","store")->name("store");
        Route::post("/update/{unit:id}","update")->name("update");
    });
});

