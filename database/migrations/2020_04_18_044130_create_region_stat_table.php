<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegionStatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('region_stats', function (Blueprint $table) {
            $table->id();
            $table->string('region');
            $table->integer('infected');
            $table->integer('infected_per_100000_ppl');
            $table->integer('intensive_care');
            $table->integer('deceased');
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
        Schema::drop('region_stats');
    }
}
