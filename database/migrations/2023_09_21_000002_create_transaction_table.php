<?php

namespace Database\Migrations;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'transactions';

    /**
     * Run the migrations.
     * @table transactions
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')
            ;
            $table->string('description');
            $table->string('operation')
            $table->string('destiny')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();


            $table->integer('client_id');
            $table->integer('user_id');

            // apt-get update or try with --fix-missing

            $table->index(["client_id"], 'fk_transansao_Client_idx');

            $table->index(["user_id"], 'fk_transansao_usuario1_idx');


            $table->foreign('client_id', 'fk_transansao_Client_idx')
                ->references('id')->on('client')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreign('user_id', 'fk_transansao_usuario1_idx')
                ->references('id')->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists($this->tableName);
    }
}
