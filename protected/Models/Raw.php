<?php

namespace App\Models;

use T4\Orm\Model;

class Raw
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
        ],
        'relations'=>[
            'ingroup'=>[
                'type'=>self::BELONGS_TO, 'model'=>Ingroup::class,
            ],
            'rawpercents'=>[
                'type'=>self::HAS_MANY, 'model'=>Rawpercent::class,
            ],
            'premixrawpercents'=>[
                'type'=>self::HAS_MANY, 'model'=>Premixrawpercent::class,
            ],
            
        ]
    ];
}