<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSersersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('server', function (Blueprint $table) {
            $table->increments('id');
            $table->string('unumber');
            $table->string('link');
            $table->string('chronicles');
            $table->integer('date_start', false, true)->nullable();
            $table->integer('rate', false, true)->nullable();
            $table->string('email');
            $table->string('social_vk');
            $table->text('description');
            $table->string('social_groupvk');
            $table->string('social_groupfb');
            $table->string('social_grouptw');
            $table->string('social_groupicq');
            $table->string('name');
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
        Schema::dropIfExists('server');
    }
}
