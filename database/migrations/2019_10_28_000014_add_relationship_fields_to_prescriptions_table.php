<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToPrescriptionsTable extends Migration
{
    public function up()
    {
        Schema::table('prescriptions', function (Blueprint $table) {
            $table->unsignedInteger('drug_id');

            $table->foreign('drug_id', 'drug_fk_527946')->references('id')->on('medicines');
        });
    }
}
