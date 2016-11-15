<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479206450_createInPercents
    extends Migration
{

    public function up()
    {
        $this->createTable('inPercents', [
            'percent'=>['type'=>'int'],
            '__inName_id'=>['type'=>'link'],
            '__inGroup_id'=>['type'=>'link']
        ]);
    }

    public function down()
    {
        $this->dropTable('inPercents');
    }
    
}