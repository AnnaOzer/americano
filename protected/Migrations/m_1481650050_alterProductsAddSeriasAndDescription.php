<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481650050_alterProductsAddSeriasAndDescription
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['description'=>['type'=>'text']]);
        $this->addColumn('products', ['__seria_id'=>['type'=>'link'],]);
        
    }

    public function down()
    {
        $this->dropColumn('products', ['description']);
        $this->dropColumn('products', ['__seria_id']);
    }
    
}