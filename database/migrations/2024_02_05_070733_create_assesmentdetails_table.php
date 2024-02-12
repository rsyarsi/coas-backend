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
        
        Schema::create('assesmentdetails', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('assesmentgroupid');
            $table->integer('assesmentnumbers');
            $table->text('assesmentdescription');
            $table->integer('assesmentbobotvalue');
            $table->integer('assesmentvaluestart');
            $table->integer('assesmentvalueend');
            $table->text('assesmentskalavalue');
            $table->integer('assesmentskalavaluestart');
            $table->integer('assesmentskalavalueend'); 
            $table->text('assesmentkonditevalue');
            $table->integer('assesmentkonditevaluestart');
            $table->integer('assesmentkonditevalueend'); 
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
        Schema::dropIfExists('assesmentdetails');
    }
};
