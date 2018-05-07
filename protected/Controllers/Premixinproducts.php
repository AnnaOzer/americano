<?php

namespace App\Controllers;

use App\Models\Premix;
use App\Models\Product;
use App\Models\Raw;
use App\Models\Premixinproduct;
use App\Models\Premixrawpercent;
use T4\Mvc\Controller;

class Premixinproducts
    extends Controller
{

    public function actionDefault()

    {
        $items = Premixinproduct::findAll();
        foreach ($items as $item) {
            $item->product;
            $item->premix;
        }
        $this->data->items = $items;
    }
    
    public function actionUpdate($id)
    {
        $item = Premixinproduct::findByPk($id);
        $item->product;
        $item->premix;
        $this->data->item = $item;
    }

    public function actionUpdatesave($premixrawpercent)
    {
        $item = (Premixrawpercent::findByPK($premixrawpercent['id']))
            ->fill($premixrawpercent)
            ->save();
        $this->redirect('/Premixs/One/?id='.$item->premix->getPk());
    }
    
    public function actionAdd($id)
    {
        $product = Product::findByPK($id);
        $premixs = Premix::findAll(['order'=>'labName']);

        $this->data->product = $product;
        $this->data->premixs = $premixs;
    }

    public function actionAddsave($premixinproduct)
    {
        $premixinproduct1 = (new Premixinproduct())
            ->fill($premixinproduct)
            ->save();
        $this->redirect('/Products/One/?id=' . $premixinproduct['__product_id']);
    }

    public function actionDelete($id)
    {
        $item=Premixinproduct::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Products/One/?id='. $item['__product_id']);
    }

}