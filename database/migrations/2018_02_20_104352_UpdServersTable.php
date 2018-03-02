<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('servers', function (Blueprint $table) {
            $table->integer('chronicle_id', false, true)->nullable();
            $table->foreign('chronicle_id')->references('id')->on('chronicles')->onDelete('SET NULL');
            $table->integer('rate_id', false, true)->nullable();
            $table->foreign('rate_id')->references('id')->on('rates')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('servers', function (Blueprint $table) {
            //
        });
    }
}
