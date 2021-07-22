<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermalinksTable extends Migration
{
    public function up()
    {
        Schema::create('permalinks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('pages')->nullable();
            $table->string('blog_posts')->nullable();
            $table->string('blog_categories')->nullable();
            $table->string('blog_tags')->nullable();
            $table->string('careers')->nullable();
            $table->string('real_estate_properties')->nullable();
            $table->string('real_estate_property_categories')->nullable();
            $table->string('real_estate_projects')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
