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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index();
            $table->unsignedBigInteger('sub_category_id')->index();
            $table->unsignedBigInteger('brand_id')->index();

            $table->string("name")->index();
            $table->string("slug")->index();
            $table->string("model")->index();
            $table->integer("order");
            $table->string("image")->nullable();
            $table->string("youtube_link")->nullable();
            $table->boolean("status")->default(true);
            $table->boolean("is_front")->default(false);

            $table->mediumText("short_des")->nullable();
            $table->longText("description")->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('cascade');

            $table->foreign('sub_category_id')
                ->references('id')
                ->on('sub_categories')
                ->onDelete('cascade');

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
