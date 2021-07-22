<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBlogsTable extends Migration
{
    public function up()
    {
        Schema::table('blogs', function (Blueprint $table) {
            $table->unsignedBigInteger('blog_categories_id')->nullable();
            $table->foreign('blog_categories_id', 'blog_categories_fk_4430162')->references('id')->on('blog_categories');
            $table->unsignedBigInteger('blog_tags_id')->nullable();
            $table->foreign('blog_tags_id', 'blog_tags_fk_4430163')->references('id')->on('blog_tags');
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id', 'template_fk_4430154')->references('id')->on('templates');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4430159')->references('id')->on('users');
        });
    }
}
