<?php

namespace App\Models;

use T4\Orm\Model;

class Buyrawjournal
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'whenbought'=>['type'=>'date'],
            'title'=>['type'=>'string'],
            'seller'=>['type'=>'string'],

            'quantitytxt'=>['type'=>'string'],
            'quantityint'=>['type'=>'int'],

            'organoleptics'=>['type'=>'string'],

            'storagetxt'=>['type'=>'string'],
            'whenmanufactured'=>['type'=>'date'],
            'whenisover'=>['type'=>'date'],
            'storageconditions'=>['type'=>'string'],

            'pricetxt'=>['type'=>'string'],
            'pricemycomment'=>['type'=>'string'],
            'priceeuro'=>['type'=>'string'],

        ],
        'relations'=>[

            'ingroup'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Ingroup::class,
            ],


            'rawseller'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Rawseller::class,
            ],


        ],

    ];
}