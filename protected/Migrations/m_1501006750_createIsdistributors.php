<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1501006750_createIsdistributors
    extends Migration
{

    public function up()
    {
        $this->createTable('isdistributors', [
            '__ingroup_id'=>['type'=>'link'],
            '__distributor_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('isdistributors');
    }


}