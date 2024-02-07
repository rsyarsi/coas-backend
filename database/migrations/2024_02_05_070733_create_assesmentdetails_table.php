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
            $table->uuid('id')->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('assesmentgroupID');
            // $table->foreign('assesmentgroupID')->references('id')->on('assesmentgroups')->onDelete('set null');
            $table->text('assementdescription');
            $table->integer('assementbobotvalue');
            $table->integer('active',false,'1');
            $table->timestamps();
        });

        // Schema::table('priorities', function($table) {
        //     $table->foreign('assesmentgroupID')->references('id')->on('assesmentgroups');
        // });
     
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
