<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481809633_alterProductAddEnglDescription
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['descriptionEng'=>['type'=>'text']]);
        
    }

    public function down()
    {
        $this->dropColumn('products', ['descriptionEng']);
    }
    
}