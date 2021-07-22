<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->boolean('is_premium')->default(0)->nullable();
            $table->longText('except')->nullable();
            $table->longText('content')->nullable();
            $table->string('type');
            $table->string('property_location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->integer('number_bedrooms')->nullable();
            $table->integer('number_bathrooms')->nullable();
            $table->integer('number_floors')->nullable();
            $table->float('square', 15, 2)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('currency')->nullable();
            $table->string('period')->nullable();
            $table->boolean('never_expired')->default(0)->nullable();
            $table->string('video_url')->nullable();
            $table->string('distance_between_facilities')->nullable();
            $table->string('moderation_status');
            $table->string('status');
            $table->string('selling_status')->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
