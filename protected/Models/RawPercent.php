<?php

namespace App\Models;

use T4\Orm\Model;

class Rawpercent
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'percent'=>['type'=>'int'],
            'nopercent'=>['type'=>'string'],

        ],
        'relations'=>[
            'raws'=>[
                'type'=>self::BELONGS_TO, 
                'model'=>Raw::class,
            ],
            'products'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Product::class,
            ]
        ]
    ];
}