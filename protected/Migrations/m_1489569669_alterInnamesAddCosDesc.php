<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1489569669_alterInnamesAddCosDesc
    extends Migration
{

    public function up()
    {
        $this->addColumn('innames', ['cosDesc'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('innames', ['cosDesc']);
    }
    
}