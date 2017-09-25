<?php

namespace App\Controllers;

use App\Models\Distributor;
use T4\Mvc\Controller;

class Distributors
    extends Controller
{

    public function actionDefault()
    {
        $items = Distributor::findAll(['order'=>'title']);
        $this->data->items = $items;
    }
    public function actionOne($id)
    {
        $item = Distributor::findByPK($id);
        $this->data->item = $item;
    }

    public function actionCreate()
    {
        
    }

    public function actionSave($distributor)
    {
        $item =
            (new Distributor())
                ->fill($distributor)
                ->save();

        $this->redirect('/Distributors/');
    }
    
    public function actionUpdate($id)
    {
        $item = Distributor::findByPK($id);
        $this->data->item = $item;
    }

    public function actionUpdatesave($distributor)
    {
        $item = Distributor::findByPK($distributor['id']);
        $item
            ->fill($distributor)
            ->save();

        $this->redirect('/Distributors/');
    }

    public function actionDelete($id)
    {
        $item = Distributor::findByPK($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Distributors/');
    }
}