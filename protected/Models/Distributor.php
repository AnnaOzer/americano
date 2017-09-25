<?php

namespace App\Models;

use T4\Orm\Model;

class Distributor
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
        ],
        'relations'=>[
            'Isdistributors'=>[
                'type'=>self::HAS_MANY,
                'model'=>Isdistributor::class,
            ],
        ]
    ];
}