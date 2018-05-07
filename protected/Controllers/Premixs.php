<?php

namespace App\Controllers;

use App\Components\Intervaler;
use App\Models\Premix;
use App\Models\Raw;
use App\Models\Rawpercent;
use T4\Mvc\Controller;

class Premixs
    extends Controller
{
    
    public function actionDefault()
    {
        $this->data->items = \App\Models\Premix::findAll();
        

    }
    
    public function actionCreate()
    {
        
    }

    public function actionSave($premix)
    {

        $item=
            (new Premix())
            ->fill($premix)
            ->save();
        
        $this->redirect('/Premixs/');
    }


    public function actionUpdate($id)
    {
        $item = Premix::findByPK($id);

        foreach ($item->premixrawpercents as $premixrawpercent) {
            $premixrawpercent->raw;
        }

        $this->data->item = $item;
    }

    public function actionUpdatesave($premix)
    {
        $ing = Premix::findByPK($premix['id']);
        $ing->fill($premix)
            ->save();

        $this->redirect('/Premixs/');
    }

    public function actionDelete($id)
    {
        $item=Premix::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Premixs/');
    }

    public function actionOne($id){
        $item=Premix::findByPK($id);
        if(empty($item)) {
            $this->redirect('/Premixs/');
        }
        $item->premixrawpercents;
        $item->premixrawpercents = $item->premixrawpercents->sort(
            function ($x1, $x2) {
                return $x2->percent <=> $x1->percent;
            }
        );
        
        foreach ($item->premixrawpercents as $line)
        {
            $line->raw;
        }
        
        $sum=0;
        foreach ($item->premixrawpercents as $premixrawpercent)
        {
            $sum+=$premixrawpercent->percent;
        }
        $item->sumPercent =$sum;
        $item->freePercent = 100000-$sum;
        

        $this->data->item = $item;

        
    }

    public function actionAdd($id)
    {
        $premix = Premix::findByPK($id);
        $raws = Raw::findAll(['order'=>'labName']);
        $this->data->premix = $premix;
        $this->data->raws = $raws;
    }
    
    public function actionAddrawsave($id, $rawpercent)
    {
        $premix = Premix::findByPK($id);
        $premix->rawpercents->add(new Rawpercent($rawpercent))
        ->save();
        $this->redirect('/Premixs/One/?id='.$id);
    }
    
    public function actionClone($id)
    {
        $premix = Premix::findByPK($id);
        $premix->rawpercents;
        $premix1 = $premix;
        $premix1->labName = 'CLONE of ' . $premix->labName;
        

        $item=
            (new Premix())
                ->fill($premix1)
                ->save();
        
        foreach ($premix->rawpercents as $rawpercent) {

            unset ($rawpercent1);
            $rawpercent1 = $rawpercent;
            $rawpercent1->__premix_id = $item->getPk();
            unset ($rawpercent1->__id);


            $itemer =
                (new Rawpercent())
                ->fill($rawpercent)
                ->save();
            
        }

        $this->redirect('/Premixs/One/?id=' . $item->getPk());
    }
    
    
}

