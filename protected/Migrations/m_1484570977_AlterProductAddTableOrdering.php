<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1484570977_AlterProductAddTableOrdering
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['orderingTable'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropColumn('products', ['orderingTable']);
    }
    
}