<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsercertificateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('usercertificate', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('issued_from_userid')->nullable();
            $table->integer('issued_to_userid')->nullable();
            $table->integer('certificate_id')->nullable();
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
        Schema::dropIfExists('usercertificate');
    }
}
