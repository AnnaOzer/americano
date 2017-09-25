<?php

namespace App\Controllers;

use App\Models\Manufacturer;
use T4\Mvc\Controller;

class Manufacturers
    extends Controller
{

    public function actionDefault()
    {
        $items = Manufacturer::findAll(['order'=>'title']);
        $this->data->items = $items;
    }
    public function actionOne($id)
    {
        $item = Manufacturer::findByPK($id);
        $this->data->item = $item;
    }

    public function actionCreate()
    {
        
    }

    public function actionSave($manufacturer)
    {
        $item =
            (new Manufacturer())
                ->fill($manufacturer)
                ->save();

        $this->redirect('/Manufacturers/');
    }
    
    public function actionUpdate($id)
    {
        $item = Manufacturer::findByPK($id);
        $this->data->item = $item;
    }

    public function actionUpdatesave($manufacturer)
    {
        $item = Manufacturer::findByPK($manufacturer['id']);
        $item
            ->fill($manufacturer)
            ->save();

        $this->redirect('/Manufacturers/');
    }

    public function actionDelete($id)
    {
        $item = Manufacturer::findByPK($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Manufacturers/');
    }
}