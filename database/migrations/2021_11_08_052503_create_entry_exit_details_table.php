<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEntryExitDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('entry_exit_details', function (Blueprint $table) {
            $table->id();
            $table->integer('entry_exit_id');
            $table->integer('detail_no');
            $table->string('transaction_div');//取引区分
            $table->integer('item_id');
            $table->string('item_name');
            $table->integer('warehouse_id');
            $table->string('warehouse_name');
            $table->integer('count');
            $table->string('unit');//　単位
            $table->unique(['entry_exit_id','detail_no']);//ユニークキーを設定する
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
        Schema::dropIfExists('entry_exit_details');
    }
}
