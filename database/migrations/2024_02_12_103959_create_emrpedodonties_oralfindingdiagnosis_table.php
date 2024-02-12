<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emrpedodonties_oralfindingdiagnosis', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('emrid');
            $table->text('oralfinding')->nullable();
            $table->text('diagnosis')->nullable();
            $table->text('treatmentplan')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('emrpedodonties_oralfindingdiagnosis');
    }
};
