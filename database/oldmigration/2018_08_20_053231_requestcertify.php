<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Requestcertify extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requestcertify', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('sponsor_id');
            $table->string('information_available');
            $table->string('all_persona_doc');
            $table->string('all_seeder_doc');
            $table->timestamp('updated_at')->nullable();
            $table->timestamp('created_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
