<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1498040915_alterInpercentsAddPercentageComment
    extends Migration
{

    public function up()
    {
        $this->addColumn('inpercents', ['percentageComment'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('inpercents', ['percentageComment']);
    }
    
}