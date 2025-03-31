
@extends('layouts.admin') @section('content') <div class="container-fluid p-0"> <div class="row no-gutters"> <div class="col-12"> <div class="clinic-settings-container"> <div class="settings-header d-flex justify-content-between align-items-center">

pasted

GAWAN MO NGA AKO NG SCHEDULE TABLE AT SCHEDULE MODEL TAPOS ETO YUNG DATA NA KAILANGAN KO

I'll create a schedule table and model based on the clinic schedule settings form in your document. Here's what I'll build for you:


Schedule Migration File
Code 

Schedule Model
Code 

Schedule Controller
Code 

Schedule Seeder
Code 

Schedule Routes
Code 
Based on your clinic schedule settings form, I've created the following:

Schedule Migration: A database migration file to create the 'schedules' table with columns for day, morning/afternoon start/end times, and active status.
Schedule Model: A model with:
Fillable attributes for day, time slots, and active status
Accessors to format time values for display (converts database time to AM/PM format)
Mutators to properly store time values in the database format
Schedule Controller: Handles:
Displaying the schedule settings page
Updating schedule settings
Initializing the schedule with default values
Schedule Seeder: Populates the database with default schedule data:
All days of the week
Default clinic hours (8-11 AM, 1-4 PM)
Monday to Friday active by default
Schedule Routes: Routes for the admin to view and update schedule settings
You can use these files to implement the schedule functionality for your clinic system. The implementation matches the form design you provided, with proper handling of the days and time slots.

SAAN KO IPAPASTE YUNG MIGRATION FILE AT SCHEDULE SEEDER ?

You'll need to place the migration file and the schedule seeder in specific directories in your Laravel project:

Migration File: Place the migration file in the database/migrations directory. Name it with a timestamp followed by the migration name, for example:
database/migrations/2025_03_31_000000_create_schedules_table.php
Schedule Seeder: Place the seeder file in the database/seeders directory:
database/seeders/ScheduleSeeder.php
After placing these files in their respective directories, you'll need to:

Run the migration:
php artisan migrate
Run the seeder:
php artisan db:seed --class=ScheduleSeeder
Alternatively, if you're adding this seeder to a fresh installation, you can add it to the DatabaseSeeder.php file in the database/seeders directory by adding this line in the run() method:

php
$this->call(ScheduleSeeder::class);
Then you can run:

php artisan migrate --seed
This will run both the migration and seeder together.


GUMAMIT KA NA LANG NG COMMAND

Here are the commands you need to use in your Laravel project to create and run the migration and seeder:

To create the migration file:
php artisan make:migration create_schedules_table
To create the seeder:
php artisan make:seeder ScheduleSeeder
After creating and editing these files with the code I provided earlier, run:
php artisan migrate
Then run the seeder:
php artisan db:seed --class=ScheduleSeeder
You can also combine migration and seeding in one command if needed:

php artisan migrate --seed
These commands will create the necessary files in the correct directories and then execute them to set up your database table and seed it with default data.







<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('day');
            $table->time('morning_start')->nullable();
            $table->time('morning_end')->nullable();
            $table->time('afternoon_start')->nullable();
            $table->time('afternoon_end')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}

