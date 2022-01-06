<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('MenuSubs', function (Blueprint $table) {
            $table->id('MenuSubID');
            $table->unsignedBigInteger('MenuID');
            $table->string('Name');
            $table->string('Title');
            $table->string('Icon');
            $table->string('RouteName');
            $table->timestamps();

            $table->foreign('MenuID')->references('MenuID')->on('Menus');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_menus');
    }
}
