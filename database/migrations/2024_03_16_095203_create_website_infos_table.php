<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('website_infos', function (Blueprint $table) {
            $table->id();
            $table->string("name")->nullable()->default("Unique Solution");
            $table->string("logo")->nullable()->default("storage/generic/logo__.png");
            $table->string("title")->nullable();

            $table->text("meta")->nullable();
            $table->text("tags")->nullable();

            $table->string("email")->nullable()->default("admin@mail.com");
            $table->string("phone")->nullable()->default("+8801754100439");
            $table->string("fb")->nullable();
            $table->string("youtube")->nullable();
            $table->string("linkedin")->nullable();
            $table->text("address")->nullable();
            $table->mediumText("map")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_infos');
    }
};
