<?php

namespace App\Models;

use T4\Orm\Model;

class InName
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'inNameEu'=>['type'=>'string'],
            'inNameUs'=>['type'=>'string'],
            'ecNumber'=>['type'=>'string'],
            'casNumber'=>['type'=>'string'],
        ],
        'relations'=>[
            'inPercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>InPercent::class,
            ]
        ]
    ];
}