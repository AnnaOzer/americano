<?php

namespace App\Models;

use T4\Orm\Model;

class InPercent
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'percent'=>['type'=>'int'],
        ],
        'relations'=>[
            'inNames'=>[
                'type'=>self::BELONGS_TO, 
                'model'=>InName::class,
            ],
            'inGroups'=>[
                'type'=>self::BELONGS_TO,
                'model'=>InGroup::class,
            ]
        ]
    ];
}