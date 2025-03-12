<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->increments('id');

            $table->string('rdt')->nullable();

            $table->string('blood_pressure')->nullable();

            $table->string('heart_rate')->nullable();

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
