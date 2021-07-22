<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectPropertyFeaturePivotTable extends Migration
{
    public function up()
    {
        Schema::create('project_property_feature', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_4430057')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('property_feature_id');
            $table->foreign('property_feature_id', 'property_feature_id_fk_4430057')->references('id')->on('property_features')->onDelete('cascade');
        });
    }
}
