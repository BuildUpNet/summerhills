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
        Schema::create('website_settings', function (Blueprint $table) {
            $table->id();
             $table->string('logo')->nullable();
    $table->string('banner_image')->nullable();
    $table->string('banner_tagline')->nullable();
      $table->string('about_image')->nullable();
        $table->string('about_heading')->nullable();
        $table->text('about_description')->nullable();
          $table->integer('year_of_exp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('website_settings');
    }
};
