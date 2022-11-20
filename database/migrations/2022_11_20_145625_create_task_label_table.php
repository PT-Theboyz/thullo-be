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
        if(!Schema::hasTable('label_task')){
            Schema::create('label_task', function (Blueprint $table) {
                $table->id();
                $table->bigInteger('label_id')->unsigned();
                $table->bigInteger('task_id')->unsigned();
                $table->foreign('label_id')
                    ->references('id')
                    ->on('labels');
                 $table->foreign('task_id')
                    ->references('id')
                    ->on('tasks'); 
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
        Schema::dropIfExists('task_label');
    }
};
