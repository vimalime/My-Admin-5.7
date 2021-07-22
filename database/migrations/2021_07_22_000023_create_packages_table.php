<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('slug')->unique();
            $table->longText('except')->nullable();
            $table->longText('content')->nullable();
            $table->boolean('is_featured')->default(0)->nullable();
            $table->boolean('is_premium')->default(0)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->string('post_status');
            $table->string('currency')->nullable();
            $table->integer('order')->nullable();
            $table->float('percent_save', 15, 2)->nullable();
            $table->integer('number_of_listings')->nullable();
            $table->integer('limit_purchase_by_account')->nullable();
            $table->boolean('is_default')->default(0)->nullable();
            $table->datetime('publish_date');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
