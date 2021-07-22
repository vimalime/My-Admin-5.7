<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityProjectPivotTable extends Migration
{
    public function up()
    {
        Schema::create('facility_project', function (Blueprint $table) {
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id', 'project_id_fk_4430058')->references('id')->on('projects')->onDelete('cascade');
            $table->unsignedBigInteger('facility_id');
            $table->foreign('facility_id', 'facility_id_fk_4430058')->references('id')->on('facilities')->onDelete('cascade');
        });
    }
}
