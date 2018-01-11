<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1515587872_createPremixs
    extends Migration
{

    public function up()
    {
        $this->createTable('premixs', [
            'labName'=>['type'=>'string'],
        ]);
        
        $this->addColumn('rawpercents', [
            '__premix_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropColumn('rawpercents', ['__premix_id']);
        $this->dropTable('premixs');
    }
    
}