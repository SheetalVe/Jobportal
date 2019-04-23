<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Createdocmaster extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('documentmaster', function (Blueprint $table) {
            $table->increments('id');
            $table->string('is_seederdoc');
            $table->string('doc_type');           
            $table->timestamps();
          });
          $data = array(
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'Brochure',
               
            ),
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'Other Commercial Presentation',
            ),
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'Proof Of Incorporation Date Of Expiry',
               
            ),
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'Other document1',
            ),
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'Other document2',
               
            ),
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'Other document3',
            ),
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'Other document4',
               
            ),
            array(
                'is_seederdoc' => '0',
                'doc_type' => 'VCard',
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Investor Teaser ',
               
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Investor Pitchbook ',
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Product White Paper',
               
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Investor Memorandum',
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Investor Financial Forecast ',
               
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Financial Statements ',
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Intellectual Property Document ',
               
            ),
            array(
                'is_seederdoc' => '1',
                'doc_type' => 'Seed Market Study',
            ),
           );
            DB::table('documentmaster')->insert($data); // Query Builder approach
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
