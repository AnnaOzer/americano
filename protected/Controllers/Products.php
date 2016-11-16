<?php

namespace App\Controllers;

use App\Models\Product;
use T4\Mvc\Controller;

class Products
    extends Controller
{

    public function actionDefault()
    {
        $this->data->items = \App\Models\Product::findAll();

    }
    
    public function actionCreate()
    {
        
    }

    public function actionSave($product)
    {
        $item=
            (new Product())
            ->fill($product)
            ->save();
        
        $this->redirect('/Products/');
    }

    public function actionDelete($id)
    {
        $item=Product::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Products/');
    }
    
}