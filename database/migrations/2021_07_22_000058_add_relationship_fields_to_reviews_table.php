<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReviewsTable extends Migration
{
    public function up()
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4430214')->references('id')->on('users');
            $table->unsignedBigInteger('page_link_id')->nullable();
            $table->foreign('page_link_id', 'page_link_fk_4430215')->references('id')->on('pages');
            $table->unsignedBigInteger('user_link_id')->nullable();
            $table->foreign('user_link_id', 'user_link_fk_4430216')->references('id')->on('users');
            $table->unsignedBigInteger('product_link_id')->nullable();
            $table->foreign('product_link_id', 'product_link_fk_4430217')->references('id')->on('products');
            $table->unsignedBigInteger('careers_link_id')->nullable();
            $table->foreign('careers_link_id', 'careers_link_fk_4430218')->references('id')->on('careers');
            $table->unsignedBigInteger('property_link_id')->nullable();
            $table->foreign('property_link_id', 'property_link_fk_4430219')->references('id')->on('properties');
            $table->unsignedBigInteger('project_link_id')->nullable();
            $table->foreign('project_link_id', 'project_link_fk_4430220')->references('id')->on('projects');
            $table->unsignedBigInteger('blog_link_id')->nullable();
            $table->foreign('blog_link_id', 'blog_link_fk_4430221')->references('id')->on('blogs');
            $table->unsignedBigInteger('package_link_id')->nullable();
            $table->foreign('package_link_id', 'package_link_fk_4430222')->references('id')->on('packages');
            $table->unsignedBigInteger('investor_link_id')->nullable();
            $table->foreign('investor_link_id', 'investor_link_fk_4430223')->references('id')->on('investors');
        });
    }
}
