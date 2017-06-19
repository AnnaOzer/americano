<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1489148158_createCosfunctionincis
    extends Migration
{

    public function up()
    {
        $this->createTable('cosfunctionincis', [
            'why'=>['type'=>'string'],
            '__cosfunction_id'=>['type'=>'link'],
            '__inname_id'=>['type'=>'link'],
        ]);
    }

    public function down()
    {
        $this->dropTable('cosfunctionincis');
    }
    
}