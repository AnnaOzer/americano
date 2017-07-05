<?php

namespace App\Controllers;

use App\Models\Seria;
use T4\Mvc\Controller;

class Tedmire
    extends Controller
{

    public function actionDefault()
    {

        $items = Seria::findAll();
        $this->data->items = $items;
    }

    public function actionBySeria($id)
    {
        
        $item = Seria::findByPk($id);
        $item->products;
        $this->data->item = $item;
    }
    
}

