<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481648981_createSerias
    extends Migration
{

    public function up()
    {
        $this->createTable('serias', [
            'title'=>['type'=>'string'],
            'description'=>['type'=>'text'],
        ]);
    }

    public function down()
    {
        $this->dropTable('serias');
    }
    
}