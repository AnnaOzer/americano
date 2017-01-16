<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481822676_alterSeriasAddOrder
    extends Migration
{

    public function up()
    {
        $this->addColumn('serias', ['order'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropColumn('serias', ['order']);
    }
    
}