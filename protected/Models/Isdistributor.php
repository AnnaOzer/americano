<?php

namespace App\Models;

use T4\Orm\Model;

class Isdistributor
    extends Model
{
    static protected $schema=[
        'columns'=>[
            
        ],
        'relations'=>[
            'Distributor'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Distributor::class,
            ],
            'Ingroup'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Ingroup::class,
            ],
        ]
    ];
}