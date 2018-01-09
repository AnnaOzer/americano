<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1513338109_updateRawpercentsAddIntervalpercent
    extends Migration
{

    public function up()
    {
        $this->addColumn('rawpercents', ['intervalpercent'=>['type'=>'text']]);
        $this->addColumn('rawpercents', ['listFunctions'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('rawpercents', ['intervalpercent']);
        $this->dropColumn('rawpercents', ['listFunctions']);
    }
    
}