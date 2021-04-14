<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBdsWard extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bds_ward', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('province_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->string('ward_name');
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
        Schema::dropIfExists('bds_ward');
    }
}
