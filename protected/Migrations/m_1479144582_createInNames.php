<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479144582_createInNames
    extends Migration
{

    public function up()
    {
        $this->createTable('inNames', [
            'inNameEu'=>['type'=>'string'],
            'inNameUs'=>['type'=>'string'],
            'ecNumber'=>['type'=>'string'],
            'casNumber'=>['type'=>'string'],
        ]);
    }

    public function down()
    {
        $this->dropTable('inNames');
    }
    
}