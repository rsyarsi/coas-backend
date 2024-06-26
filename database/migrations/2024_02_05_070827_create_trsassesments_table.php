<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trsassesments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('assesmentgroupid');
            $table->uuid('studentid');
            $table->uuid('lectureid');
            $table->uuid('yearid');
            $table->uuid('semesterid');  
            $table->uuid('specialistid');  
            $table->dateTime('transactiondate'); 
            $table->integer('grandotal'); 
            $table->integer('assesmenttype'); 
            $table->integer('active',false,'1');
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
        Schema::dropIfExists('trsassesments');
    }
};
