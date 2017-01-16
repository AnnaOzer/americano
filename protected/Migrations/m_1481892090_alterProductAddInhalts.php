<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481892090_alterProductAddInhalts
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['listRus'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('products', ['listRus']);
    }
    
}