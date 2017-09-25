<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1501006023_createIsmanufacturers
    extends Migration
{

    public function up()
    {
        $this->createTable('ismanufacturers', [
            '__ingroup_id'=>['type'=>'link'],
            '__manufacturer_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('ismanufacturers');
    }
    
}