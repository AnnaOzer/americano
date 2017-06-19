<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1489147109_createCosfunctions
    extends Migration
{

    public function up()
    {
        $this->createTable('cosfunctions', [
            'titleEng'=>['type'=>'string'],
            'titleRu'=>['type'=>'string'],
        ]);
    }

    public function down()
    {
        $this->dropTable('cosfunctions');
    }
    
}