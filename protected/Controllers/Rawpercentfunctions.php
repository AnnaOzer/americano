<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Rawpercent;
use App\Models\Raw;
use T4\Mvc\Controller;
use App\Components\Preformulator;

class Rawpercentfunctions
    extends Controller
{



    public function actionDefault()
    {

    }

    public function actionUpdate($id) {

        $this->data->rawpercent = $rawpercent = Rawpercent::findByPK($id);
        $this->data->item = Preformulator::EuPreformulator($rawpercent->product->Pk);
    }


    public function actionUpdateOld($id)
    {
        $rawpercent = Rawpercent::findByPK($id);
        $product = Product::findByPK($rawpercent->product->Pk);
        $raw = Raw::findByPK($rawpercent->raw->Pk);


        $rawpercent->product=$product;

        $rawpercent->raw = $raw;


        $this->data->rawpercent = $rawpercent;

    }

    public function actionUpdatesave(Rawpercent $rawpercent) {

        $item = (Rawpercent::findByPK($rawpercent['id']))
            ->fill($rawpercent)
            ->save();
        $this->redirect('/Eu/One/?id=' . $item->product->Pk);
    }



}