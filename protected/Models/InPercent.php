<?php

namespace App\Models;

use T4\Orm\Model;

class Inpercent
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'percent'=>['type'=>'int'],
        ],
        'relations'=>[
            'innames'=>[
                'type'=>self::BELONGS_TO, 
                'model'=>Inname::class,
            ],
            'ingroups'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Ingroup::class,
            ]
        ]
    ];
}