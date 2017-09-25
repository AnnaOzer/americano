<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1501005870_createDistributors
    extends Migration
{
    public function up()
    {
        $this->createTable('distributors', [
            'title'=>['type'=>'text'],
            'contacts'=>['type'=>'text'],
        ]);
    }

    public function down()
    {
        $this->dropTable('distributors');
    }
    
}