<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('board_user')){
            Schema::create('board_user', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('user_id')->unsigned();
                $table->bigInteger('board_id')->unsigned(); 
                $table->timestamps();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
                 $table->foreign('board_id')
                    ->references('id')
                    ->on('boards');
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('board_user');
    }
};
