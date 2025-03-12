<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->increments('id'); // This creates an integer primary key instead of bigInteger
            $table->unsignedInteger('user_id'); // Match the users.id type
            $table->unsignedInteger('doctor_id')->nullable(); // Match the users.id type
            $table->string('fullname');
            $table->string('email');
            $table->string('contact');
            $table->string('gender');
            $table->date('dob');
            $table->text('address');
            $table->text('ailment');
            $table->dateTime('appointment_date');
            $table->string('status')->default('Pending');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('doctor_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('appointments');
    }
}