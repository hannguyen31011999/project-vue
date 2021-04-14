<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBdsProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bds_product', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('type_id')->unsigned();
            $table->integer('categories_id')->unsigned();
            $table->integer('province_id')->unsigned();
            $table->integer('district_id')->unsigned();
            $table->integer('ward_id')->unsigned();
            $table->string('title');
            $table->double('area');
            $table->double('price');
            $table->string('address');
            $table->text('desc');
            $table->date('date_start');
            $table->date('date_end');
            $table->integer('status');
            $table->softDeletes();
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
        Schema::dropIfExists('bds_product');
    }
}
