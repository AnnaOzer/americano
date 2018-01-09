<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1510562148_addTypeofrecepture
    extends Migration
{

    public function up()
    {
        $this->createTable('typeofreceptures', [
            'title'=>['type'=>'string'],
            'comment'=>['type'=>'string'], 
        ]);
        
        $this->addColumn('products', ['__typeofrecepture_id'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropTable('typeofreceptures');
        $this->dropColumn('products', ['__typeofrecepture_id']);
    }
    
}