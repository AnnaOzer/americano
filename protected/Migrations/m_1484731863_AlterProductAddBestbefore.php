<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1484731863_AlterProductAddBestbefore
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['bestbefore'=>['type'=>'text']]);
        $this->addColumn('products', ['bestbeforeEng'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('products', ['bestbefore']);
        $this->dropColumn('products', ['bestbeforeEng']);
    }
    
}