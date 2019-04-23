<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsdocumentToConnectUserStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('connect_user_status', function (Blueprint $table) {
            $table->enum('isdocpermission', ['yes', 'no'])->after('request_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('connect_user_status', function (Blueprint $table) {
            //
        });
    }
}
