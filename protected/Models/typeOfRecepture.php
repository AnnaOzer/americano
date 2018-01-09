<?php

namespace App\Models;

use T4\Orm\Model;

class Typeofrecepture
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
            'comment'=>['type'=>'string'],
        ],
        'relations'=>[
            'rawpercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>Product::class,
            ]
        ]
    ];
}