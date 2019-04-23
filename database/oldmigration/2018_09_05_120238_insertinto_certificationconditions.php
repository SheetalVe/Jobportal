<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertintoCertificationconditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       
        DB::table('Certificationconditions')->insert([
            'cirtificate_type' => '1',
            'relation_by' => '(sponsorship)',
            'description' => 'Key documents and Seed evaluated and certified in detail by a Gold certified Grower'
        ],
        [
            'cirtificate_type' => '2',
            'relation_by' => '(sponsorship)',
            'description' => 'At least one key document certified (i.e. noogahchecked) by a Silver or Gold certified Grower'
        ]
              
            );       
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
