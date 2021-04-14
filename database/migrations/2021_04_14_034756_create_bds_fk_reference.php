<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBdsFkReference extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bds_district', function ($table) {
            $table->foreign('province_id')->references('id')->on('bds_province')->onDelete('cascade');
        });

        Schema::table('bds_ward', function ($table) {
            $table->foreign('province_id')->references('id')->on('bds_province')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('bds_district')->onDelete('cascade');
        });

        Schema::table('bds_user', function ($table) {
            $table->foreign('id_role')->references('id')->on('bds_role_permission')->onDelete('cascade');
        });

        Schema::table('bds_order', function ($table) {
            $table->foreign('user_id')->references('id')->on('bds_user')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('bds_product')->onDelete('cascade');
        });

        Schema::table('bds_post', function ($table) {
            $table->foreign('user_id')->references('id')->on('bds_user')->onDelete('cascade');
        });

        Schema::table('bds_variant', function ($table) {
            $table->foreign('product_id')->references('id')->on('bds_product')->onDelete('cascade');
        });

        Schema::table('bds_product_image', function ($table) {
            $table->foreign('product_id')->references('id')->on('bds_product')->onDelete('cascade');
        });

        Schema::table('bds_slug', function ($table) {
            $table->foreign('product_id')->references('id')->on('bds_product')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('bds_categories')->onDelete('cascade');
        });

        Schema::table('bds_product', function ($table) {
            $table->foreign('type_id')->references('id')->on('bds_product_type')->onDelete('cascade');
            $table->foreign('categories_id')->references('id')->on('bds_categories')->onDelete('cascade');
            $table->foreign('province_id')->references('id')->on('bds_province')->onDelete('cascade');
            $table->foreign('district_id')->references('id')->on('bds_district')->onDelete('cascade');
            $table->foreign('ward_id')->references('id')->on('bds_ward')->onDelete('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bds_fk_reference');
    }
}
