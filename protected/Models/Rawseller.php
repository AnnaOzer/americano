<?php

namespace App\Models;

use T4\Orm\Model;

class Rawseller
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
        ],
        'relations'=>[
            'buyrawjournals'=>[
                'type'=>self::HAS_MANY,
                'model'=>Buyrawjournal::class,
            ],
        ]
    ];
}