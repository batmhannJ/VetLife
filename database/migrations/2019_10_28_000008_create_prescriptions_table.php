<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrescriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('prescriptions', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('quantity_issued');

            $table->date('date_issued');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
