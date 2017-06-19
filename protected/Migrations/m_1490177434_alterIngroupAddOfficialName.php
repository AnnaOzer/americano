<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1490177434_alterIngroupAddOfficialName
    extends Migration
{

    public function up()
    {
        $this->addColumn('ingroups', ['officialName'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('ingroups', ['officialName']);
    }
    
}