<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSelectsponsorToRequestcertifiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('requestcertifies', function (Blueprint $table) {
            $table->enum('selectsponsor', ['0', '1','2'])->after('payment_method');	
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('requestcertifies', function (Blueprint $table) {
            //
        });
    }
}
