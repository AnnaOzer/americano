<?php

namespace App\Models;

use T4\Orm\Model;

class Test
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'], 
            'image'=>['type'=>'string'],
        ],
      
    ];
}