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
        Schema::create('emrpedodonties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('noregister', 25);
            $table->string('noepisode', 25);
            $table->string('physicalgrowth', 3);
            $table->string('heartdesease', 3);
            $table->string('bruiseeasily', 3);
            $table->string('anemia', 3);
            $table->string('hepatitis', 3);
            $table->string('allergic', 3);
            $table->string('takinganymedicine', 3);
            $table->string('beenhospitalized', 3);
            $table->string('toothache', 3);
            $table->string('childtoothache', 3);
            $table->string('firstdental', 3);
            $table->string('unfavorabledentalexperience', 3);
            $table->text('ifyes', 250);
            $table->text('where', 250);
            $table->text('reason', 250);
            $table->string('fingersucking', 150);
            $table->string('diffycultyopeningsjaw', 3);
            $table->text('howoftenbrushtooth', 100);
            $table->string('usefluoridepasta', 3);
            $table->string('fluoridetreatmen', 3);
            $table->text('bilateralsymmetry', 250);
            $table->text('asymmetry', 250);
            $table->text('straight', 250);
            $table->text('convex', 250);
            $table->text('concave', 250);
            $table->string('lipsseal', 10);
            $table->string('clicking', 3);
            $table->string('clickingleft', 10);
            $table->string('clickingright', 10);
            $table->string('pain', 3);
            $table->string('painleft', 10);
            $table->string('painright', 10);
            $table->string('bodypostur', 50);
            $table->string('stageofdentition', 50);
            $table->text('gingivitis', 250);
            $table->text('stomatitis', 250);
            $table->text('gumboil', 250);
            $table->string('dentalanomali', 3);
            $table->text('prematurloss', 250);
            $table->text('overretainedprimarytooth', 250);

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
        Schema::dropIfExists('emrpedodonties');
    }
};