<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuParametersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MenuParameters', function (Blueprint $table) {
            $table->id('MenuParameterID');
            $table->unsignedBigInteger('MenuID')->nullable();
            $table->unsignedBigInteger('MenuSubID')->nullable();
            $table->string('ParamKey');
            $table->string('ParamValue');
            $table->timestamps();

            $table->foreign('MenuID')->references('MenuID')->on('Menus');
            $table->foreign('MenuSubID')->references('MenuSubID')->on('MenuSubs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_parameters');
    }
}
