<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryExitSlipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_exit_slips', function (Blueprint $table) {
            $table->id();
            $table->integer('entry_exit_id');
            $table->date('slip_date');
            $table->string('slip_div');
            $table->string('update_user');
            $table->timestamps();
            $table->unique(['entry_exit_id']);//ユニークキーを設定する
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('entry_exit_slips');
    }
}
