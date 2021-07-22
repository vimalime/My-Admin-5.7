<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBlogTagsTable extends Migration
{
    public function up()
    {
        Schema::table('blog_tags', function (Blueprint $table) {
            $table->unsignedBigInteger('template_id')->nullable();
            $table->foreign('template_id', 'template_fk_4430136')->references('id')->on('templates');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id', 'author_fk_4430137')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4430141')->references('id')->on('users');
        });
    }
}
