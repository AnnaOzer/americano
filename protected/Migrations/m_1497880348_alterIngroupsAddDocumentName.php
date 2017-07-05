<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1497880348_alterIngroupsAddDocumentName
    extends Migration
{

    public function up()
    {
        $this->addColumn('ingroups', ['documentName'=>['type'=>'text']]);
    }

    public function down()
    {
        $this->dropColumn('ingroups', ['documentName']);
    }
    
}