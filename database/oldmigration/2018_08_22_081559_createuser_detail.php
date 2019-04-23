<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateuserDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('user_detail', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('company_name')->nullable();
            $table->string('type_of_company')->nullable();
            $table->string('sector')->nullable();
            $table->string('slogan')->nullable();
            $table->text('query')->nullable();
            $table->string('description')->nullable();
            $table->string('website')->nullable();           
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
