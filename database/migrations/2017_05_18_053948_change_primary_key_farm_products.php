<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePrimaryKeyFarmProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(){
        //TODO
        Schema::table('farm_produce', function (Blueprint $table) {
            $table->dropPrimary('primary');
            $table->primary(['id', 'name']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('farm_products', function (Blueprint $table) {
            //
        });
    }
}
