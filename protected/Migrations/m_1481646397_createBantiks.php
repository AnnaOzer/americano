<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481646397_createBantiks
    extends Migration
{

    public function up()
    {
        $this->createTable('bantiks', [
            'title'=>['type'=>'string'],
            'comment'=>['type'=>'string'],
        ]);

        $this->createTable('bantiks_to_rawpercents', [
            '__bantik_id'=>['type'=>'link'],
            '__rawpercent_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('bantiks_to_rawpercents');
        $this->dropTable('bantiks');
    }
    
}