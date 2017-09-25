<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1501005571_createManufacturer
    extends Migration
{

    public function up()
    {
        $this->createTable('manufacturers', [
            'title'=>['type'=>'text'],
        ]);
    }

    public function down()
    {
        $this->dropTable('manufacturers');
    }
    
}