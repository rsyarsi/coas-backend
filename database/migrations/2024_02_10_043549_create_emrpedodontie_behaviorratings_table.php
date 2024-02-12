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
        Schema::create('emrpedodontie_behaviorratings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('emrid');
            $table->text('frankscale');
            $table->text('beforetreatment');
            $table->text('duringtreatment');
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
        Schema::dropIfExists('emrpedodontie_behaviorratings');
    }
};