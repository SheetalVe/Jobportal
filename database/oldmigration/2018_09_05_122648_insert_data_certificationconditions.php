<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDataCertificationconditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('Certificationconditions')->insert(
        [
            'cirtificate_type' => '2',
            'relation_by' => '(sponsorship)',
            'description' => 'At least one key document certified (i.e. noogahchecked) by a Silver or Gold certified Grower'
        ],
        [
            'cirtificate_type' => '3',
            'relation_by' => '(or, self-certification)',
            'description' => 'CV and Skillset certified by a Gold certified Harvester'
        ],
        [
            'cirtificate_type' => '3',
                    'relation_by' => '(or co-sponsorship)',
                    'description' => 'Certification by at least 3 members including either Gold certified Growers or Silver certified Harvesters'
        ],
        [
            'cirtificate_type' => '3',
            'relation_by' => '(or 3rd party references)',
            'description' => 'Verified by noogah'
        ],
        [
            'cirtificate_type' => '4',
            'relation_by' => '(sponsorship)',
            'description' => 'CV and Skillset certified by a Gold certified Grower or a Silver or Gold certified Harvester'
        ],
        [
            'cirtificate_type' => '4',
            'relation_by' => '(or co-sponsorship)',
            'description' => 'Certification by at least 3 members including either Gold certified Seeds, Silver certified Growers or other Harvesters'
        ],
        [
            'cirtificate_type' => '5',
            'relation_by' => '(sponsorship)',
            'description' => 'Investor profile certified by a Gold certified Harvester'
        ]
        ,
        [
            'cirtificate_type' => '5',
            'relation_by' => '(or co-sponsorship)',
            'description' => 'Certification by at least 3 members including either Gold certified Growers or Silver certified Harvesters'
        ]
        ,
        [
            'cirtificate_type' => '6',
                    'relation_by' => '(co-sponsorship)',
                    'description' => 'Certification by at least 3 Gold certified Harvesters'
        ],
        [
            'cirtificate_type' => '6',
                    'relation_by' => '(or 3rd party references)',
                    'description' => 'Verified by noogah'
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
