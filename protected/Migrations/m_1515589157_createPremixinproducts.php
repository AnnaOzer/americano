<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1515589157_createPremixinproducts
    extends Migration
{

    public function up()
    {
        $this->createTable('premixinproducts', [
            'percent'=>['type'=>'int'],
            '__premix_id'=>['type'=>'link'],
            '__product_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('premixinproducts');
    }
    
}