<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479385574_alterIngroups
    extends Migration
{

    public function up()
    {
        $this->addColumn('ingroups', ['ruName'=>['type'=>'string']]);
    }

    public function down()
    {
        $this->dropColumn('ingroups', ['ruName']);
    }
    
}