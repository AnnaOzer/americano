<?php

namespace App\Models;

use T4\Orm\Model;

class Dater
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'titleRus'=>['type'=>'string'],
            'titleEng'=>['type'=>'string'],
            'comment'=>['type'=>'string'],
        ],
        'relations'=>[
            'upaks'=>[
                'type'=>self::MANY_TO_MANY,
                'model'=>Product::class,
            ]
        ]
    ];
}