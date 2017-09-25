<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1504775799_updateIngroupAddIsActive
    extends Migration
{

    public function up()
    {
        $this->addColumn('ingroups', ['isActive'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('ingroups', ['isActive']);
    }
    
}