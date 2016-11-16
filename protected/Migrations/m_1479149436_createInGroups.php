<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479149436_createInGroups
    extends Migration
{

    public function up()
    {
        $this->createTable('ingroups', [
            'title'=>['type'=>'string']
        ]);
    }

    public function down()
    {
        $this->dropTable('ingroups');
    }
    
}