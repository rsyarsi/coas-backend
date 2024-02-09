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
            $table->text('assesmentdescription');
            $table->integer('assesmentbobotvalue');
            $table->text('assesmentskalavalue');
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
