<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1480592467_alterRawpercentLiposomes
    extends Migration
{

    public function up()
    {
        $this->addColumn('rawpercents', ['decomposition'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropColumn('rawpercents', ['decomposition']);
    }
    
}