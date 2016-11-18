<?php

namespace App\Controllers;

use App\Models\Ingroup;
use App\Models\Inname;
use App\Models\Inpercent;
use App\Models\Product;
use App\Models\Raw;
use App\Models\Rawpercent;
use T4\Mvc\Controller;

class Inpercents
    extends Controller
{

    public function actionDefault()
    {
        
    }
    
    public function actionUpdate($id)
    {
        $item = Inpercent::findByPk($id);
        $item->inname;
        $item->ingroup;
        $this->data->item = $item;
    }

    public function actionUpdatesave($inpercent)
    {
        $item = (Inpercent::findByPK($inpercent['id']))
            ->fill($inpercent)
            ->save();
        $this->redirect('/Ingroups/One/?id='.$item->__ingroup_id);
    }
    
    public function actionAdd($id)
    {
        $ingroup = Ingroup::findByPK($id);
        $innames = Inname::findAll(['order'=>'inNameEu']);
        $this->data->ingroup = $ingroup;
        $this->data->innames = $innames;
    }

    public function actionAddsave($inpercent)
    {
        $inp = (new Inpercent())
            ->fill($inpercent)
            ->save();
        $this->redirect('/Ingroups/One/?id=' . $inpercent['__ingroup_id']);
    }

    public function actionOne($id)
    {
        $item=Ingroup::findByPK($id);
        if(empty($item)) {
            $this->redirect('/Ingroups/');
        }
        $item->inpercents;

        foreach ($item->inpercents as $line)
        {
            $line->inname;
        }
    }
}