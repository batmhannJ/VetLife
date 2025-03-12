<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientPrescriptionPivotTable extends Migration
{
    public function up()
    {
        Schema::create('patient_prescription', function (Blueprint $table) {
            $table->unsignedInteger('prescription_id');

            $table->foreign('prescription_id', 'prescription_id_fk_527373')->references('id')->on('prescriptions')->onDelete('cascade');

            $table->unsignedInteger('patient_id');

            $table->foreign('patient_id', 'patient_id_fk_527373')->references('id')->on('patients')->onDelete('cascade');
        });
    }
}
