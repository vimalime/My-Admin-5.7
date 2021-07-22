<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSlidersTable extends Migration
{
    public function up()
    {
        Schema::table('sliders', function (Blueprint $table) {
            $table->unsignedBigInteger('page_link_id')->nullable();
            $table->foreign('page_link_id', 'page_link_fk_4430230')->references('id')->on('pages');
            $table->unsignedBigInteger('product_link_id')->nullable();
            $table->foreign('product_link_id', 'product_link_fk_4430231')->references('id')->on('products');
            $table->unsignedBigInteger('careers_link_id')->nullable();
            $table->foreign('careers_link_id', 'careers_link_fk_4430232')->references('id')->on('careers');
            $table->unsignedBigInteger('property_link_id')->nullable();
            $table->foreign('property_link_id', 'property_link_fk_4430233')->references('id')->on('properties');
            $table->unsignedBigInteger('project_link_id')->nullable();
            $table->foreign('project_link_id', 'project_link_fk_4430234')->references('id')->on('projects');
            $table->unsignedBigInteger('blog_link_id')->nullable();
            $table->foreign('blog_link_id', 'blog_link_fk_4430235')->references('id')->on('blogs');
            $table->unsignedBigInteger('package_link_id')->nullable();
            $table->foreign('package_link_id', 'package_link_fk_4430236')->references('id')->on('packages');
            $table->unsignedBigInteger('investor_link_id')->nullable();
            $table->foreign('investor_link_id', 'investor_link_fk_4430237')->references('id')->on('investors');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4430245')->references('id')->on('users');
        });
    }
}
