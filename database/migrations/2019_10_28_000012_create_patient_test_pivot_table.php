<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientTestPivotTable extends Migration
{
    public function up()
    {
        Schema::create('patient_test', function (Blueprint $table) {
            $table->unsignedInteger('test_id');

            $table->foreign('test_id', 'test_id_fk_527299')->references('id')->on('tests')->onDelete('cascade');

            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id', 'patient_id_fk_527299')->references('id')->on('patients')->onDelete('cascade');
        });
    }
}
