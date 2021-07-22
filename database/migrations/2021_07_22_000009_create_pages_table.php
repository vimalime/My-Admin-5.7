<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTable extends Migration
{
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('except')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->boolean('is_premium')->default(0)->nullable();
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->string('status')->nullable();
            $table->datetime('publish_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
