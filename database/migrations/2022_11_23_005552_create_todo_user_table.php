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
        if(!Schema::hasTable('todo_user')){
            Schema::create('todo_user', function (Blueprint $table) {
                $table->id();
                // $table->foreignId('todo_id');
                // $table->foreignId('user_id');
                $table->bigInteger('user_id')->unsigned();
                $table->bigInteger('todo_id')->unsigned();
                $table->foreign('user_id')
                    ->references('id')
                    ->on('users');
                $table->foreign('todo_id')
                    ->references('id')
                    ->on('todos'); 
                $table->timestamps();
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
        Schema::dropIfExists('todo_user');
    }
};
