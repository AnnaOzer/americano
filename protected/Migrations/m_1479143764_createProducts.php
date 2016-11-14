<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479143764_createProducts
    extends Migration
{

    public function up()
    {
        $this->createTable('products', [
            'labName'=>['type'=>'string'],
            'rusName'=>['type'=>'string'],
            'engName'=>['type'=>'string'],
            'dateSigned'=>['type'=>'date'],
        ]);
    }

    public function down()
    {
        $this->dropTable('products');
    }
    
}