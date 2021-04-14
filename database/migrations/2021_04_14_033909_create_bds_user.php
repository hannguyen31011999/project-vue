<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBdsUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bds_user', function (Blueprint $table) {
            $table->Increments('id');
            $table->integer('id_role')->unsigned();
            $table->char('email',100)->unique();
            $table->char('password');
            $table->string('fullname');
            $table->date('birth_date')->nullable();
            $table->integer('gender')->nullable();
            $table->string('address')->nullable();
            $table->char('cmnd',20);
            $table->char('phone',11);
            $table->char('remember_token')->nullable();
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
        Schema::dropIfExists('bds_user');
    }
}
