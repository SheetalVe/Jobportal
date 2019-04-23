<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InsertDataintotCertificationconditions extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $data = array(
            array(
                'cirtificate_type' => '3',
                'relation_by' => '(or, self-certification)',
                'description' => 'CV and Skillset certified by a Gold certified Harvester'
            ),
            array(
                'cirtificate_type' => '3',
                'relation_by' => '(or co-sponsorship)',
                'description' => 'Certification by at least 3 members including either Gold certified Growers or Silver certified Harvesters'
            ),
            array(
                'cirtificate_type' => '3',
                'relation_by' => '(or 3rd party references)',
                'description' => 'Verified by noogah'
            ),
            array(
                'cirtificate_type' => '4',
                'relation_by' => '(sponsorship)',
                'description' => 'CV and Skillset certified by a Gold certified Grower or a Silver or Gold certified Harvester'
            ),
            array(
                'cirtificate_type' => '4',
                'relation_by' => '(or co-sponsorship)',
                'description' => 'Certification by at least 3 members including either Gold certified Seeds, Silver certified Growers or other Harvesters'
            ),
            array(
                'cirtificate_type' => '5',
                'relation_by' => '(sponsorship)',
                'description' => 'Investor profile certified by a Gold certified Harvester'
            ),
            array(
                'cirtificate_type' => '5',
                'relation_by' => '(or co-sponsorship)',
                'description' => 'Certification by at least 3 members including either Gold certified Growers or Silver certified Harvesters'
            ),
            array(
                'cirtificate_type' => '6',
                'relation_by' => '(co-sponsorship)',
                'description' => 'Certification by at least 3 Gold certified Harvesters'
            ),
            array(
                'cirtificate_type' => '6',
                'relation_by' => '(or 3rd party references)',
                'description' => 'Verified by noogah'
            ));
            DB::table('Certificationconditions')->insert($data); // Query Builder approach

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
