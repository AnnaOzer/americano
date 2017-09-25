<?php

namespace App\Models;

use T4\Orm\Model;

class Manufacturer
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
        ],
        'relations'=>[
            'Ismanufacturers'=>[
                'type'=>self::HAS_MANY,
                'model'=>Ismanufacturer::class,
            ],
        ]
    ];
}