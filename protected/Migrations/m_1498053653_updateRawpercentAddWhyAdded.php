<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1498053653_updateRawpercentAddWhyAdded
    extends Migration
{

    public function up()
    {
        $this->addColumn('rawpercents', ['whyAdded'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('rawpercents', ['whyAdded']);
    }


}