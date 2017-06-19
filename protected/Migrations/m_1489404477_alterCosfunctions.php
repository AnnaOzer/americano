<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1489404477_alterCosfunctions
    extends Migration
{

    public function up()
    {
        $this->addColumn('cosfunctions', ['from'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('cosfunctions', ['from']);
    }
    
}