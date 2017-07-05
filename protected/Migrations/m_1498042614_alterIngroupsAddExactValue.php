<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1498042614_alterIngroupsAddExactValue
    extends Migration
{

    public function up()
    {
        $this->addColumn('ingroups', ['exactValue'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('ingroups', ['exactValue']);
    }
    
}