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
        Schema::create('detail_todos', function (Blueprint $table) {
            $table->id();
            $table->string('detail_pengerjaan');
            $table->string('progress_pengerjaan');
            $table->string('hasil')->nullable()->change();
            $table->string('status');
            $table->date('due_date')->nullable();
            $table->string('attachment')->nullable()->change();
            $table->string('note')->nullable()->change();
            $table->foreignId('todo_id');
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
        Schema::dropIfExists('detail_todos');
    }
};
