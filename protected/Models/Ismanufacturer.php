<?php

namespace App\Models;

use T4\Orm\Model;

class Ismanufacturer
    extends Model
{
    static protected $schema=[
        'columns'=>[
            
        ],
        'relations'=>[
            'Manufacturer'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Manufacturer::class,
            ],
            'Ingroup'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Ingroup::class,
            ],
        ]
    ];
}