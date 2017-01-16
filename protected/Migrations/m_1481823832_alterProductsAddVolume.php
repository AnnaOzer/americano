<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481823832_alterProductsAddVolume
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['volume'=>['type'=>'string']]);
        $this->addColumn('products', ['volumeEng'=>['type'=>'string']]);

    }

    public function down()
    {
        $this->dropColumn('products', ['volume']);
        $this->dropColumn('products', ['volumeEng']);


    }
    
}