<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479214895_createRawPercents
    extends Migration
{

    public function up()
    {
        $this->createTable('rawpercents', [
            'percent'=>['type'=>'int'],
            'nopercent'=>['type'=>'string'],
            '__raw_id'=>['type'=>'link'],
            '__product_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('rawpercents');
    }
    
}