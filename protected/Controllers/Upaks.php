<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Seria;
use T4\Mvc\Controller;

class Upaks
    extends Controller
{

    public function actionDefault()
    {
        $items = Seria::findAll();

        foreach ($items as $item) {
            $item->products;

            foreach ($item->products as $product) {
                $product->upak->daters;
            }
        }

        $this->data->items = $items;
    }



}