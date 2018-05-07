<?php

namespace App\Models;

use T4\Orm\Model;

class Premix
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'labName'=>['type'=>'string'],
        ],
        
        'relations'=> [

            'premixrawpercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>Premixrawpercent::class,
            ],
        ]
    ];
    
    
    

    
}