<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481797645_alterProductAddOrderingInSerias
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['ordering'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropColumn('products', ['ordering']);
    }
    
}