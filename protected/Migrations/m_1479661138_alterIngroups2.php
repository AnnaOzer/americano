<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1479661138_alterIngroups2
    extends Migration
{

    public function up()
    {
        $this->addColumn('ingroups', ['priority'=>['type'=>'int']]);
    }

    public function down()
    {
        $this->dropColumn('ingroups', ['priority']);
    }
}