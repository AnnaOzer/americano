<?php

namespace App\Models;

use T4\Orm\Model;

class Inname
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'inNameEu'=>['type'=>'string'],
            'inNameUs'=>['type'=>'string'],
            'ecNumber'=>['type'=>'string'],
            'casNumber'=>['type'=>'string'],

            'cosDesc'=>['type'=>'text'],
        ],
        'relations'=>[
            'inpercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>Inpercent::class,
            ],
            'cosfunctionincis'=>[
                'type'=>self::HAS_MANY,
                'model'=>Cosfunctioninci::class,
            ],
            'productinciorders'=>[
                'type'=>self::HAS_MANY,
                'model'=>Productinciorder::class,
            ],
        ]
    ];
}