<?php

namespace App\Models;

use T4\Orm\Model;

class Productinciorder
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'order'=>['type'=>'int'],
            'whyAdded'=> ['type'=>'string'],
            'listFunctions'=> ['type'=>'string'],
        ],
        'relations'=>[
            'product'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Product::class,
            ],
            'inname'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Inname::class,
            ],
            

        ]
    ];
}