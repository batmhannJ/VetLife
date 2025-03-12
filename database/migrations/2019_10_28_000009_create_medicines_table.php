<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->unique();

            $table->string('generic_name')->nullable();

            $table->string('item_code')->unique();

            $table->string('type');

            $table->string('uos');

            $table->string('received_from');

            $table->integer('qty_received')->nullable();

            $table->datetime('date_received');

            $table->date('expiry_date');

            $table->timestamps();

            $table->softDeletes();
        });
    }
}
