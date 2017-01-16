<?php

namespace App\Models;

use T4\Orm\Model;

class Seria
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
            'titleEng'=>['type'=>'string'],
            'description'=>['type'=>'text'],
            'descriptionEng'=>['type'=>'text'],
            'order'=>['type'=>'int'],
        ],
        'relations'=>[
            'products'=>[
                'type'=>self::HAS_MANY,
                'model'=>Product::class,
            ]
        ]
    ];
}