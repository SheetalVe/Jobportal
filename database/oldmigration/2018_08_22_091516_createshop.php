<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createshop extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('persona_type');
            $table->string('voucher_name');
            $table->string('short_description');
            $table->string('voucher_price');                   
            $table->string('voucher_discount_price');                   
            $table->string('voucher_code');                   
            $table->string('voucher_pic');                   
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
