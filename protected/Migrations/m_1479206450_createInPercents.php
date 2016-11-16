<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479206450_createInPercents
    extends Migration
{

    public function up()
    {
        $this->createTable('inpercents', [
            'percent'=>['type'=>'int'],
            '__inname_id'=>['type'=>'link'],
            '__ingroup_id'=>['type'=>'link']
        ]);
    }

    public function down()
    {
        $this->dropTable('inpercents');
    }
    
}