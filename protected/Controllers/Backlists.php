<?php

namespace App\Controllers;

use App\Models\Product;
use T4\Mvc\Controller;

class Backlists
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
            $item->inhalts = $item->EuInhalts($item->getPk());
        }

        $this->data->items = $items;
    }

    public function actionUs()
    {
        $items = Product::findAll();

        foreach ($items as $item)
        {
            $item->inhalts = $item->UsInhalts($item->getPk());
        }

        $this->data->items = $items;
    }

    public function actionRu()
    {
        $items = Product::findAll();

        foreach ($items as $item)
        {
            $item->inhalts = $item->RuInhalts($item->getPk());
        }

        $this->data->items = $items;
    }

}