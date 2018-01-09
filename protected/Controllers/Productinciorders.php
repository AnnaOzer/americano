<?php

namespace App\Controllers;

use App\Models\Inname;
use App\Models\Product;
use App\Models\Productinciorder;
use T4\Core\Std;
use T4\Mvc\Controller;

class Productinciorders
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionUpdate($product_id, $inci_id)
    {
        $this->data->product = Product::findByPK($product_id);
        $this->data->inname = Inname::findByPK($inci_id);
        $this->data->productinciorder = Productinciorder::find(['where'=>'__product_id=' . $product_id .' and __inname_id='. $inci_id]);
        //$this->data->productinciorder = Productinciorder::find(['where'=>'__product_id=50 and __inname_id=11']);
        //$this->data->productinciorder = Productinciorder::findByAttributes(['__product_id'=> 50, '__inname_id' => 11]);

        //var_dump($this->data->productinciorder); die;
    }
    
    public function actionSave($productinciorder)
    {
        if( NULL != Productinciorder::find(
                [
                    'where' =>
                    '__product_id=' . $productinciorder['__product_id'] . ' and __inname_id=' . $productinciorder['__inname_id']
                ]
            ))
        {

            $exactproductinciorder = Productinciorder::find(
                [
                    'where'=>
                    '__product_id=' . $productinciorder['__product_id'] . ' and __inname_id=' . $productinciorder['__inname_id']

                ]);

            $exactproductinciorder->fill($productinciorder)
                ->save();
        } else {
        $item =
            (new Productinciorder())
                ->fill($productinciorder)
                ->save();
        }
        $this->redirect('/Eu/OnePreingredients?id='. $productinciorder['__product_id']);
    }

}