<?php

namespace App\Models;

use T4\Orm\Model;

class Upak
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
            'description'=>['type'=>'text'],
        ],
        'relations'=>[
            'products'=>[
                'type'=>self::HAS_MANY,
                'model'=>Product::class,
            ],

            'daters'=>[
                'type'=>self::MANY_TO_MANY,
                'model'=>Dater::class,
            ],
        ]
    ];
}