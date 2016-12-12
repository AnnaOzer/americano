<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1480420967_alterRawpercentProduct_addManualOrder
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['manualOrderingOn'=>['type'=>'int']]);
        $this->addColumn('rawpercents', ['manualOrder'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropColumn('products', ['manualOrderingOn']);
        $this->dropColumn('rawpercents', ['manualOrder']);
    }
    
}