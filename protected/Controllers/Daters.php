<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Seria;
use App\Models\Upak;
use T4\Mvc\Controller;

class Daters
    extends Controller
{

    public function actionDefault()
    {
        $items = Upak::findAll();
        
        foreach ($items as $item) {
            $item->daters;
        }

        

        $this->data->items = $items;
    }

    public function actionCreate()
    {

    }

    public function actionSave($upak)
    {
        $item=
            (new Upak())
                ->fill($upak)
                ->save();

        $this->redirect('/Daters/');
    }



}