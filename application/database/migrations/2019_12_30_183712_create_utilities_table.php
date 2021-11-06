<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUtilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('utilities');
        Schema::create('utilities', function (Blueprint $table) {
            $table->increments('id');
            $table->mediumText('about_us')->nullable();
            $table->mediumText('privacy_statement')->nullable();
            $table->mediumText('terms_conditions')->nullable();
            $table->mediumText('shipment_policy')->nullable();
            $table->mediumText('return_policy')->nullable();
            $table->mediumText('how_to_return')->nullable();
            $table->mediumText('others')->nullable();
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
        Schema::dropIfExists('utilities');
    }
}
