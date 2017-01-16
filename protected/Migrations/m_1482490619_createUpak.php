<?php

namespace App\Migrations;

use T4\Orm\Migration;

class m_1482490619_createUpak
    extends Migration
{

    public function up()
    {
        $this->createTable('upaks', [
            'titleRus'=>['type'=>'string'],
            'titleEng'=>['type'=>'string'],
            'comment'=>['type'=>'string'],
            

        ]);

        $this->createTable('daters', [
            'bestbefore'=>['type'=>'string'],
            
        ]);
        
        
        $this->createTable('upaks_to_daters', [
                '__id_upak'=>['type'=>'link'],
                '__id_dater'=>['type'=>'link'],
            ]
        );

        $this->addColumn('products', ['__upak_id'=>['type'=>'link']]);
    }

    public function down()
    {
        $this->dropTable('upaks');
        $this->dropTable('daters');
        $this->dropTable('upaks_to_daters');
        $this->dropColumn('products', ['__upak_id']);
    }
    
}