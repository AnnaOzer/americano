<?php

namespace App\Models;

use T4\Orm\Model;

class Cosfunction
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'titleEng'=>['type'=>'string'],
            'titleRu'=>['type'=>'string'],
            'from'=>['type'=>'text'],
            
        ],
        'relations'=>[
            'cosfunctionincis'=>[
                'type'=>self::HAS_MANY,
                'model'=>Cosfunctioninci::class,
            ],

        ]
    ];
}