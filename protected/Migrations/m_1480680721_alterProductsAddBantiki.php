<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1480680721_alterProductsAddBantiki
    extends Migration
{

    public function up()
    {
        $this->addColumn('products', ['bantiki'=>['type'=>'string']]);
    }

    public function down()
    {
        $this->dropColumn('products', ['bantiki']);
    }


}