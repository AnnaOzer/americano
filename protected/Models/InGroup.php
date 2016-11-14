<?php

namespace App\Models;

use T4\Orm\Model;

class InGroup
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
        ]
    ];
}