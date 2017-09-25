<?php

namespace App\Models;

use T4\Orm\Model;

class Productinciorder
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'order'=>['type'=>'int'],
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