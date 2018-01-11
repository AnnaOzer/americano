<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1515663852_createPremixrawpercents
    extends Migration
{

    public function up()
    {
        $this->createTable('premixrawpercents', [
            'percent'=>['type'=>'int'],
            'nopercent'=>['type'=>'string'],

            'manualOrder'=>['type'=>'int'],
            'decomposition'=>['type'=>'int'],
            'whyAdded'=>['type'=>'string'],
            'intervalpercent'=> ['type'=>'string'],
            'listFunctions'=> ['type'=>'string'],

            '__raw_id'=>['type'=>'link'],
            '__premix_id'=>['type'=>'link'],
        ]);

        $this->createTable('bantiks_to_premixrawpercents', [
            '__bantik_id'=>['type'=>'link'],
            '__premixrawpercent_id'=>['type'=>'link'],
        ]);
        
        $this->dropColumn('rawpercents', ['__premix_id']);
    }

    public function down()
    {
        $this->addColumn('rawpercents', ['__premix_id'=>['type'=>'link']]);
        
        $this->dropTable('bantiks_to_premixrawpercents');
        
        $this->dropTable('premixrawpercents');
    }
    
}