<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Rawpercent;
use T4\Core\Collection;
use T4\Mvc\Controller;

class Ingredients
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionEu()
{
    $items=Product::findAll();
    foreach ($items as $item) {
        $item->rawpercents;

        foreach ($item->rawpercents as $line) {
            $ingroupId = $line->raw->ingroup->getPk();
            $line->title = $line->raw->ingroup->EuLister($ingroupId);
            $line->interval = $line->StandartInterval($line->percent);
            $line->orderby = $line->interval['order'];

        }

        $item = $item->rawpercents->sort(
            function (Rawpercent $x1, Rawpercent $x2) {
                return ($x2->orderby <=> $x1->orderby);
            }
        );

    }
    $this->data->items = $items;

}

    public function actionEuOne($id)
    {
        $item=Product::findByPk($id);

            $item->rawpercents;

            foreach ($item->rawpercents as $line) {
                $ingroupId = $line->raw->ingroup->getPk();
                $line->title = $line->raw->ingroup->EuLister($ingroupId);
                $line->interval = $line->StandartInterval($line->percent);
                $line->orderby = $line->interval['order'];
                $line->priorityby = $line->raw->ingroup->priority;

            }

            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {

                    if($x1->orderby > 2 || $x2->orderby > 2 ) {
                        if((int)$x1->orderby !== (int)$x2->orderby  ) {
                            return ($x2->orderby <=> $x1->orderby);
                        } else {
                            return ($x1->priorityby <=> $x2->priorityby);
                        }

                    } else {
                        return ($x1->priorityby <=> $x2->priorityby);
                    }

                }
            );
        
    
        $this->data->item = $item;

    }
    public function actionUs()
    {
        $items = Product::findAll();
        foreach ($items as $item)
        {
            $item->rawpercents;

            foreach ($item->rawpercents as $line)
            {
                $ingroupId = $line->raw->ingroup->getPk();
                $line->title = $line->raw->ingroup->UsLister($ingroupId);
                $line->interval = $line->StandartInterval($line->percent)['interval'];

            }

            $item2 = $item->rawpercents->sort(
                function(Rawpercent $x1, Rawpercent $x2)
                {
                    return ((int)$x1->percent <=> (int)$x2->percent);
                }
            );

            $item = $item2;
        }

        $this->data->items = $items;

    }

    public function actionRu()
    {
        $items = Product::findAll();
        foreach ($items as $item)
        {
            $item->rawpercents;

            foreach ($item->rawpercents as $line)
            {
                $ingroupId = $line->raw->ingroup->getPk();
                $line->title = $line->raw->ingroup->RuLister($ingroupId);
                $line->interval = $line->StandartInterval($line->percent)['interval'];

            }

            $item2 = $item->rawpercents->sort(
                function(Rawpercent $x1, Rawpercent $x2)
                {
                    return ((int)$x1->percent <=> (int)$x2->percent);
                }
            );

            $item = $item2;
        }

        $this->data->items = $items;

    }

}