<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralsTable extends Migration
{
    public function up()
    {
        Schema::create('generals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('admin_email');
            $table->string('timezone')->nullable();
            $table->string('admin_title');
            $table->string('google_site_verification')->nullable();
            $table->string('google_analytics')->nullable();
            $table->string('analytics_view')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
