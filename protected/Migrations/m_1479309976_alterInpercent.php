<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479309976_alterInpercent
    extends Migration
{

    public function up()
    {
        $this->addColumn('inpercents', ['ordering'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropColumn('inpercents', ['ordering']);
    }
    
}