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
        Schema::create('assesmentgroups', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('specialistid');
            $table->text('assementgroupname');
            $table->integer('type');
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
        Schema::dropIfExists('assesmentgroups');
    }
};
