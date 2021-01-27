<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Raw;
use App\Models\Rawpercent;
use T4\Mvc\Controller;

class Rawpercents
    extends Controller
{

    public function actionDefault()
    {
        
    }
    
    public function actionUpdate($id)
    {
        $item = Rawpercent::findByPk($id);
        $item->raw;
        $item->product;
        $this->data->item = $item;
    }

    public function actionUpdatesave($rawpercent)
    {
        $item = (Rawpercent::findByPK($rawpercent['id']))
            ->fill($rawpercent)
            ->save();
        $this->redirect('/Products/Oneprice/?id='.$item->product->getPk());
    }
    
    public function actionAdd($id)
    {
        $product = Product::findByPK($id);
        $raws = Raw::findAll(['order'=>'title']);
        $this->data->product = $product;
        $this->data->raws = $raws;
    }

    public function actionAddsave($rawpercent)
    {
        $rawp = (new Rawpercent())
            ->fill($rawpercent)
            ->save();
        $this->redirect('/Products/One/?id=' . $rawpercent['__product_id']);
    }

    public function actionDelete($id)
    {
        $item=Rawpercent::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Products/One/?id='. $item['__product_id']);
    }

}