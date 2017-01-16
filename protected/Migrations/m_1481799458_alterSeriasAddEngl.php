<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481799458_alterSeriasAddEngl
    extends Migration
{

    public function up()
    {
        $this->addColumn('serias', ['titleEng'=>['type'=>'string']]);
        $this->addColumn('serias', ['descriptionEng'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('serias', ['titleEng']);
        $this->dropColumn('serias', ['descriptionEng']);
    }
    
}