<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    public function up()
    {

        Schema::create('patients', function (Blueprint $table) {
            $table->increments('id');
            
            // Personal Information
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->date('dob');
            $table->string('email')->nullable();
            $table->string('phone')->nullable(); // Changed from integer to string to accommodate formats like +1234567890
            $table->text('address');
            $table->string('pin_code')->nullable(); // Changed from pin_code and removed unique constraint
            $table->string('blood_group')->nullable();
            
            // Emergency Contact Information
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('emergency_contact_address')->nullable();
            
            // System fields
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('patients');
    }
}