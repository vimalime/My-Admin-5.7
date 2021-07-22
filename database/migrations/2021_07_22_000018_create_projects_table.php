<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type')->nullable();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->boolean('is_premium')->default(0)->nullable();
            $table->longText('except')->nullable();
            $table->longText('content')->nullable();
            $table->string('property_location')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('period')->nullable();
            $table->boolean('never_expired')->default(0)->nullable();
            $table->string('video_url')->nullable();
            $table->string('distance_between_facilities')->nullable();
            $table->integer('number_blocks')->nullable();
            $table->integer('number_floors')->nullable();
            $table->integer('number_flats')->nullable();
            $table->decimal('lowest_price', 15, 2)->nullable();
            $table->string('currency')->nullable();
            $table->decimal('max_price', 15, 2)->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->datetime('finish_date')->nullable();
            $table->datetime('open_sell_date')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
