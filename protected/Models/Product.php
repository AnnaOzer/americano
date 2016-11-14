<?php

namespace App\Models;

use T4\Orm\Model;

class Product
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'labName'=>['type'=>'string'],
            'rusName'=>['type'=>'string'],
            'engName'=>['type'=>'string'],
            'dateSigned'=>['type'=>'date'],
        ]
    ];
}