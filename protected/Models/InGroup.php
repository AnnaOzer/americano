<?php

namespace App\Models;

use T4\Orm\Model;

class InGroup
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
        ],
        'relations'=>[
            'inPercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>InPercent::class,
            ],
            'raws'=>[
                'type'=>self::HAS_MANY,
                'model'=>Raw::class,
            ]
        ]
    ];
}