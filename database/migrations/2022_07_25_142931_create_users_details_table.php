<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_details', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->string('address', 100);
            $table->string('phone', 20)->nullable();
            $table->date('birth')->nullable();

            $table->primary('user_id');
            $table->foreign('user_id')->references('id')->on('users');//->onDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_details');
    }
}
