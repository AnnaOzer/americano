<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1499263225_createProductinciorder
    extends Migration
{

    public function up()
    {
        $this->createTable('productinciorders', [
            'order'=>['type'=>'int'],
            '__product_id'=>['type'=>'link'],
            '__inname_id'=>['type'=>'link'],
        ]);

        $this->addColumn('products', ['manualProductinciorder'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropTable('productinciorders');

        $this->dropColumn('products', ['manualProductinciorder']);
    }


}