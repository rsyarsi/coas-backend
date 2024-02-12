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
        Schema::create('type_one_trsdetailassesments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('trsassesmentid');
            $table->uuid('assesmentdetailid');
            $table->text('assesmentdescription');
            $table->dateTime('transactiondate')->nullable(); 
            $table->integer('assesmentbobotvalue');
            $table->text('assesmentskala')->nullable(); 
            $table->integer('assementscore'); 
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
        Schema::dropIfExists('trsassesmentdetails');
    }
};
