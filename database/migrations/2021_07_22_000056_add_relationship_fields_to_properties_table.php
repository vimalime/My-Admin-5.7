<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPropertiesTable extends Migration
{
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->unsignedBigInteger('country_id')->nullable();
            $table->foreign('country_id', 'country_fk_4430082')->references('id')->on('countries');
            $table->unsignedBigInteger('state_id')->nullable();
            $table->foreign('state_id', 'state_fk_4430081')->references('id')->on('states');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_4430080')->references('id')->on('cities');
            $table->unsignedBigInteger('property_type_id')->nullable();
            $table->foreign('property_type_id', 'property_type_fk_4430108')->references('id')->on('property_types');
            $table->unsignedBigInteger('property_features_id')->nullable();
            $table->foreign('property_features_id', 'property_features_fk_4430112')->references('id')->on('property_features');
            $table->unsignedBigInteger('facilities_id')->nullable();
            $table->foreign('facilities_id', 'facilities_fk_4430113')->references('id')->on('facilities');
            $table->unsignedBigInteger('project_id')->nullable();
            $table->foreign('project_id', 'project_fk_4430116')->references('id')->on('projects');
            $table->unsignedBigInteger('author_id')->nullable();
            $table->foreign('author_id', 'author_fk_4430115')->references('id')->on('users');
            $table->unsignedBigInteger('created_by_id')->nullable();
            $table->foreign('created_by_id', 'created_by_fk_4430102')->references('id')->on('users');
        });
    }
}
