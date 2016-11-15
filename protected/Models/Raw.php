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
            'inGroups'=>[
                'type'=>self::BELONGS_TO, 'model'=>InGroup::class,
            ]
        ]
    ];
}