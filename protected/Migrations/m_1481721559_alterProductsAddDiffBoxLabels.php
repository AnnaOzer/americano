<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481721559_alterProductsAddDiffBoxLabels
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['for'=>['type'=>'string']]);
        $this->addColumn('products', ['how'=>['type'=>'text']]);
        $this->addColumn('products', ['shortdesc'=>['type'=>'text']]);
        $this->addColumn('products', ['danger'=>['type'=>'string']]);
    }

    public function down()
    {
        $this->dropColumn('products', ['for']);
        $this->dropColumn('products', ['how']);
        $this->dropColumn('products', ['shortdesc']);
        $this->dropColumn('products', ['danger']);
    }
    
}