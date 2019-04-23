<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createuser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('users', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contact_no')->nullable();
            $table->string('email')->nullable();
            $table->string('gender')->nullable();
            $table->string('long')->nullable();
            $table->text('address')->nullable();
            $table->string('lat')->nullable();
            $table->string('setting')->nullable();
            $table->string('profilepic')->nullable();
            $table->string('type_of_person')->nullable();
            $table->string('user_type_int')->nullable();
            $table->string('password');
            $table->string('remember_token')->nullable();
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
        
    }
}
