<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479209745_createRaws
    extends Migration
{

    public function up()
    {
        $this->createTable('raws', [
            'title'=>['type'=>'string'],
            '__inGroup_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('raws');
    }
    
}