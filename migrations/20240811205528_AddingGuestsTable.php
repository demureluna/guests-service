<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager;
use Phpmig\Migration\Migration;

class AddingGuestsTable extends Migration
{
    /**
     * Creating Guests table
     */
    public function up()
    {
        Manager::schema()
            ->create('guests', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('surname');
                $table->string('email')->unique();
                $table->string('phone')->unique();
                $table->string('country');
                $table->timestamps();
            });
    }

    /**
     * Undo the migration
     */
    public function down()
    {
        Manager::schema()
            ->dropIfExists('guests');
    }
}
