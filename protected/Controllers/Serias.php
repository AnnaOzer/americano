<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Seria;
use T4\Mvc\Controller;

class Serias
    extends Controller
{

    public function actionDefault()
    {
        $items = Seria::findAll();
        foreach ($items as $item){
            $item->products=$item->products->sort(
                function (Product $x1, Product $x2) {
                    return $x1->ordering <=> $x2->ordering;
                 }
            );
        }
        $this->data->items = $items;

    }

    public function actionCreate()
    {

    }

    public function actionSave($seria)
    {
        $item=
            (new Seria())
                ->fill($seria)
                ->save();

        $this->redirect('/Serias/');
    }

    public function actionUpdate($id)
    {
        $item = Seria::findByPK($id);
        $this->data->item = $item;
    }

    public function actionDelete($id)
    {
        $item=Seria::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Serias/');
    }
    
    public function actionUpdatesave($seria)
    {
        $item = Seria::findByPK($seria['id']);
        $item->fill($seria)
            ->save();

        $this->redirect('/Serias/');
    }
    
    public function actionAddProduct($id)
    {
        $seria = Seria::findByPk($id);
        $this->data->seria = $seria;

        $products = Product::findAll();

        $this->data->products = $products;
        

    }

    public function actionAddProductSave($product)
    {
        $ser = Seria::findByPK($product['__seria_id']);
        $prod = Product::findByPK($product['id']);
        $ser->products->add($prod);
        
        $ser->save();

        $this->redirect('/Serias/');
    }

    public function actionAddProductDescription($id)
    {
        $product = Product::findByPK($id);
        $this->data->item = $product;

       
}

    public function actionAddProductDescriptionSave($item)
    {
        $product = Product::findByPK($item['id']);
        $product->fill($item);

        $product->save();

        $this->redirect('/Products/');
    }
}