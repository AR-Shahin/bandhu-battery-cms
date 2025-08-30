<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\SingleContent;
use App\Models\User;
use App\Models\WebsiteInfo;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        if(app()->isLocal()){
            Admin::create([
                "name" => "Super Admin",
                "email" => "admin@mail.com",
                "password" => bcrypt("password")
            ]);


            Admin::create([
                "name" => "Viewer",
                "email" => "viewer@mail.com",
                "password" => bcrypt("password")
            ]);

            Admin::create([
                "name" => "Shahin",
                "email" => "mdshahinmije96@gmail.com",
                "password" => bcrypt("password")
            ]);
        }else{
            Admin::create([
                "name" => "Super Admin",
                "email" => "admin@mail.com",
                "password" => bcrypt("password")
            ]);


            Admin::create([
                "name" => "Viewer",
                "email" => "viewer@mail.com",
                "password" => bcrypt("password")
            ]);

            Admin::create([
                "name" => "Shahin",
                "email" => "mdshahinmije96@gmail.com",
                "password" => bcrypt("password")
            ]);
            Admin::create([
                "name" => "Super Admin",
                "email" => "super@mail.com",
                "password" => bcrypt("password_")
            ]);
        }


        $seeders = [
            RoleSeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            ServiceSeeder::class,
            SingleContentSeeder::class,
        ];

        $local = [
            CategorySeeder::class,
            SubCategorySeeder::class,
            BrandSeeder::class,
            ProductSeeder::class
        ];
        if(app()->isLocal()){
           $seeders = array_merge($seeders,$local);
        }
        WebsiteInfo::create([]);
            $this->call($seeders);
        }
}
