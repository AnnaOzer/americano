<?php

namespace App\Models;

use T4\Orm\Model;

class Ingroup
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'title'=>['type'=>'string'],
            'documentName'=>['type'=>'text'],
            'officialName'=>['type'=>'text'],
            'billingName'=>['type'=>'text'],
            'ruName'=>['type'=>'string'],
            'priority'=>['type'=>'int'],
            'exactValue'=>['type'=>'int'],
            'isActive'=>['type'=>'int'],
            
        ],
        'relations'=>[
            'inpercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>Inpercent::class,
            ],
            'raws'=>[
                'type'=>self::HAS_MANY,
                'model'=>Raw::class,
            ],
            'isdistributors'=>[
                'type'=>self::HAS_MANY,
                'model'=>Isdistributor::class,
            ],
            'ismanufacturers'=>[
                'type'=>self::HAS_MANY,
                'model'=>Ismanufacturer::class,
            ],
            'buyrawjournals'=>[
                'type'=>self::HAS_MANY,
                'model'=>Buyrawjournal::class,
            ],
        ]
    ];

    public function EuLister($id)
    {
        $item=Ingroup::findByPK($id);

        foreach ($item->inpercents as $line)
        {
            $line->title = $line->inname->inNameEu;

        };

        $item2 = $item->inpercents->sort(function(Inpercent $x1, Inpercent $x2){ return ((int)$x1->ordering <=> (int)$x2->ordering); });

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ' (and) ');

        return $listString;

    }

    public function UsLister($id)
    {
        $item=Ingroup::findByPK($id);

        foreach ($item->inpercents as $line)
        {
            $line->title = $line->inname->inNameUs;

        };

        $item2 = $item->inpercents->sort(function(Inpercent $x1, Inpercent $x2){ return ((int)$x1->ordering <=> (int)$x2->ordering); });

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ' (and) ');

        return $listString;

    }

    public function RuLister($id)
    {
        $item=Ingroup::findByPK($id);

        return $item->ruName;

    }

}