<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogsTable extends Migration
{
    public function up()
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name')->nullable();
            $table->string('slug')->unique();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->boolean('is_premium')->default(0)->nullable();
            $table->longText('excerpt')->nullable();
            $table->longText('content')->nullable();
            $table->datetime('post_date');
            $table->string('meta_title')->nullable();
            $table->longText('meta_description')->nullable();
            $table->longText('meta_keywords')->nullable();
            $table->string('status');
            $table->string('format')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
