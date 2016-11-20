<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Rawpercent;
use T4\Mvc\Controller;

class Ingredients
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionEu()
    {
        $items = Product::findAll();
        foreach ($items as $item)
        {
            $item->rawpercents;

            foreach ($item->rawpercents as $line)
            {
                $ingroupId = $line->raw->ingroup->getPk();
                $line->title = $line->raw->ingroup->EuLister($ingroupId);
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