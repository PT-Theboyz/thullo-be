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
        Schema::table('detail_todos', function (Blueprint $table) {
            $table->string('hasil')->nullable()->change();
            $table->string('attachment')->nullable()->change();
            $table->string('note')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_todos', function (Blueprint $table) {
            $table->string('hasil')->nullable()->change();
            $table->string('attachment')->nullable()->change();
            $table->string('note')->nullable()->change();
        });
    }
};
