<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameFarmProduceToFarmProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $farm_produce = 'farm_produce';
        $farm_products = 'farm_products';
        Schema::rename($farm_produce, $farm_products);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farm_produce', function (Blueprint $table) {
            //
        });
    }
}
