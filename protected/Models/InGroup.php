<?php

namespace App\Models;

use T4\Orm\Model;

class Ingroup
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
        ],
        'relations'=>[
            'inpercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>Inpercent::class,
            ],
            'raws'=>[
                'type'=>self::HAS_MANY,
                'model'=>Raw::class,
            ]
        ]
    ];
}