<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createuserdocs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('userdocs', function (Blueprint $table) 
        {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('doc_type')->nullable();
            $table->string('doc_name')->nullable();
            $table->string('doc_main_type')->nullable();                   
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
