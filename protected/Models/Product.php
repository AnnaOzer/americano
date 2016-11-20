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
        ],
        'relations'=> [
            'rawpercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>Rawpercent::class,
            ]
        ]
    ];


    public function EuInhalts($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $line)
        {
            $ingroupId = $line->raw->ingroup->getPk();
            $line->title = $line->raw->ingroup->EuLister($ingroupId);
            $line->range = $line->StandartInterval($line->percent);

        };

        $item2 = $item->rawpercents->sort(
            function(Rawpercent $x1, Rawpercent $x2)
            {
                if (!((int)$x1->range->order == (int)$x2->range->order)) {
                    return ((int)$x1->range->order <=> (int)$x2->range->order);
                }
                return ($x1->raw->ingroup->priority <=> $x2->raw->ingroup->priority);
            }
        );

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ', ');

        return $listString;

    }

    public function UsInhalts($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $line)
        {
            $ingroupId = $line->raw->ingroup->getPk();
            $line->title = $line->raw->ingroup->UsLister($ingroupId);

        };

        $item2 = $item->rawpercents->sort(
            function(Rawpercent $x1, Rawpercent $x2)
            {
                if (!((int)$x1->range->order == (int)$x2->range->order)) {
                    return ((int)$x1->range->order <=> (int)$x2->range->order);
                }
                return ($x1->raw->ingroup->priority <=> $x2->raw->ingroup->priority);
            }
        );

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ', ');

        return $listString;

    }

    public function RuInhalts($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $line)
        {
            $ingroupId = $line->raw->ingroup->getPk();
            $line->title = $line->raw->ingroup->RuLister($ingroupId);

        };

        $item2 = $item->rawpercents->sort(
            function(Rawpercent $x1, Rawpercent $x2)
            {
                if (!((int)$x1->range->order == (int)$x2->range->order)) {
                    return ((int)$x1->range->order <=> (int)$x2->range->order);
                }
                return ($x1->raw->ingroup->priority <=> $x2->raw->ingroup->priority);
            }
        );

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ', ');

        return $listString;
    }

}