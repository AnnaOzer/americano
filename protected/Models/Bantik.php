<?php

namespace App\Models;

use T4\Orm\Model;

class Bantik
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
            'comment'=>['type'=>'string'],
        ],
        'relations'=>[
            'rawpercents'=>[
                'type'=>self::MANY_TO_MANY,
                'model'=>Rawpercent::class,
            ], 
            'premixrawpercents'=>[
                'type'=>self::MANY_TO_MANY,
                'model'=>Premixrawpercent::class,
            ]
        ]
    ];
}