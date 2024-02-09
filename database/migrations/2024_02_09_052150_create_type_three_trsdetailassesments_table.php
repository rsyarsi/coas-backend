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
        Schema::create('type_three_trsdetailassesments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('trsassementid');
            $table->uuid('assesmentdetailid');
            $table->text('assementdescription');
            $table->dateTime('transactiondate');
            $table->text('assementskala');
            $table->integer('assementbobotvalue');
            $table->integer('assessmentvalue'); 
            $table->integer('konditevalue'); 
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
        Schema::dropIfExists('type_three_trsdetailassesments');
    }
};
