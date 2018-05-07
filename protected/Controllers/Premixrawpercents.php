<?php

namespace App\Controllers;

use App\Models\Premix;
use App\Models\Raw;
use App\Models\Premixrawpercent;
use T4\Mvc\Controller;

class Premixrawpercents
    extends Controller
{

    public function actionDefault()
    {
        
    }
    
    public function actionUpdate($id)
    {
        $item = Premixrawpercent::findByPk($id);
        $item->raw;
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
        $premix = Premix::findByPK($id);
        $raws = Raw::findAll(['order'=>'title']);

        $this->data->premix = $premix;
        $this->data->raws = $raws;
    }

    public function actionAddsave($premixrawpercent)
    {

        $premixrawpercent = (new Premixrawpercent())
            ->fill($premixrawpercent)
            ->save();
        $this->redirect('/Premixs/One/?id=' . $premixrawpercent['__premix_id']);
    }

    public function actionDelete($id)
    {
        $item=Premixrawpercent::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Premixs/One/?id='. $item['__premix_id']);
    }

}