<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToProjectsTable extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_4430040')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id', 'state_fk_4430039')->references('id')->on('states');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_4430038')->references('id')->on('cities');
            $table->unsignedBigInteger('property_features_id')->nullable();
            $table->foreign('property_features_id', 'property_features_fk_4430064')->references('id')->on('property_features');
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->foreign('property_type_id', 'property_type_fk_4430065')->references('id')->on('property_types');
            $table->unsignedBigInteger('investors_id')->nullable();
            $table->foreign('investors_id', 'investors_fk_4430072')->references('id')->on('investors');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4430056')->references('id')->on('users');
        });
    }
}
