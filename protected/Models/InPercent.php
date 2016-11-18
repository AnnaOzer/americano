<?php

namespace App\Models;

use T4\Orm\Model;

class Inpercent
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'percent'=>['type'=>'int'],
            'ordering'=>['type'=>'int'],
        ],
        'relations'=>[
            'inname'=>[
                'type'=>self::BELONGS_TO, 
                'model'=>Inname::class,
            ],
            'ingroup'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Ingroup::class,
            ]
        ]
    ];
}