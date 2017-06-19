<?php

namespace App\Models;

use T4\Orm\Model;

class Cosfunctioninci
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'why'=>['type'=>'string'],
            
        ],
        'relations'=>[
            'cosfunction'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Cosfunction::class,
            ],

            'inname'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Inname::class,
            ],
        ]
    ];
}