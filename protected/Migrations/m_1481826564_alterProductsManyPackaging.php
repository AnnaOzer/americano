<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1481826564_alterProductsManyPackaging
    extends Migration
{

    public function up()
    {
        
        $this->addColumn('products', ['dangerEng'=>['type'=>'string']]);

        $this->addColumn('products', ['forEng'=>['type'=>'string']]);

        $this->addColumn('products', ['bantikiEng'=>['type'=>'string']]);
        $this->addColumn('products', ['howEng'=>['type'=>'text']]);

        $this->addColumn('products', ['shortdescEng'=>['type'=>'text']]);
    }

    public function down()
    {

        
        $this->dropColumn('products', ['dangerEng']);

        $this->dropColumn('products', ['forEng']);

        $this->dropColumn('products', ['bantikiEng']);
        $this->dropColumn('products', ['howEng']);

        $this->dropColumn('products', ['shortdescEng']);
    }
    
}