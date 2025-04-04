<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPetColumnsToPatients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patients', function (Blueprint $table) {
            // Remove these emergency contact columns if they exist but aren't in your actual database
            // You may need to comment these out if they don't exist in your database yet
            if (Schema::hasColumn('patients', 'emergency_contact_name')) {
                $table->dropColumn('emergency_contact_name');
            }
            if (Schema::hasColumn('patients', 'emergency_contact_relationship')) {
                $table->dropColumn('emergency_contact_relationship');
            }
            if (Schema::hasColumn('patients', 'emergency_contact_phone')) {
                $table->dropColumn('emergency_contact_phone');
            }
            if (Schema::hasColumn('patients', 'emergency_contact_address')) {
                $table->dropColumn('emergency_contact_address');
            }
            
            // Add pet columns that are missing
            if (!Schema::hasColumn('patients', 'pet_name')) {
                $table->string('pet_name')->nullable();
            }
            if (!Schema::hasColumn('patients', 'pet_type')) {
                $table->string('pet_type')->nullable();
            }
            if (!Schema::hasColumn('patients', 'pet_breed')) {
                $table->string('pet_breed')->nullable();
            }
            if (!Schema::hasColumn('patients', 'pet_dob')) {
                $table->date('pet_dob')->nullable();
            }
            if (!Schema::hasColumn('patients', 'pet_age')) {
                $table->integer('pet_age')->nullable();
            }
            if (!Schema::hasColumn('patients', 'pet_gender')) {
                $table->string('pet_gender', 50)->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patients', function (Blueprint $table) {
            // Remove the pet columns we added
            $table->dropColumn([
                'pet_name',
                'pet_type',
                'pet_breed',
                'pet_dob',
                'pet_age',
                'pet_gender'
            ]);
            
            // Restore the emergency contact columns if you had them before
            // Comment these out if they were never in your database
            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_relationship')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->text('emergency_contact_address')->nullable();
        });
    }
}