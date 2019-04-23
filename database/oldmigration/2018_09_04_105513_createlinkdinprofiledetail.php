<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createlinkdinprofiledetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('social_linkdin_accounts', function (Blueprint $table) {
            $table->integer('userid');
            $table->string('linkdin_id');
            $table->string('first-name');
            $table->string('last-name');
            $table->text('headline');
            $table->string('location');
            $table->string('industry');
            $table->text('summary');
            $table->text('specialties');
            $table->string('num-connections');
            $table->string('picture-url');
            $table->string('site-standard-profile-request');
            $table->string('api-standard-profile-request');
            $table->string('position-id');
            $table->string('position-title');
            $table->text('position-summary');
            $table->string('position-start-date');
            $table->string('position-end-date');
            $table->string('position-iscurrent');
            $table->text('position-company');
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
        //
    }
}
