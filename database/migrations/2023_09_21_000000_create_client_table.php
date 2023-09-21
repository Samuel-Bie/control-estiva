<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

  /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'clients';

    /**
     * Run the migrations.
     * @table client
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->string('id_nr')->nullable();

            $table->string('description')->nullable();
            $table->integer('contact')->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender')->nullable();

            $table->string('company')->nullable();
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
        Schema::dropIfExists($this->tableName);
    }
};




