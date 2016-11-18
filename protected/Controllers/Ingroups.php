<?php

namespace App\Controllers;

use App\Models\Ingroup;
use App\Models\Inpercent;
use App\Models\Product;
use App\Models\Raw;
use T4\Core\Collection;
use T4\Mvc\Controller;

class Ingroups
    extends Controller
{

    public function actionDefault()
    {
        $items = \App\Models\Ingroup::findAll(['order'=>'title']);

        foreach ($items as $item)
        {
            $item->raws;

            foreach ($item->raws as $line)
            {
                if (!empty($line->rawpercents)) {

                    foreach ($line->rawpercents as $line2) {
                        $line2->product;
                    }
                }


            }


        $this->data->items = $items;
        
        }
    }
    
    public function actionCreate($id=null)
    {
        if(!empty($id)){
            $this->data->rawid = $id;
        } else {
            $this->data->rawid = null;
        }
                
    }

    public function actionSave($ingroup)
    {
        $item=
            (new Ingroup())
            ->fill($ingroup)
            ->save();
        
        $this->redirect('/Ingroups/');
    }

    public function actionDelete($id)
    {
        $item=Ingroup::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Products/');
    }
    
    public function actionUpdate($id)
    {
        $item = Ingroup::findByPK($id);
        $this->data->item = $item;
    }
    
    public function actionUpdatesave($ingroup)
    {
        $ing = Ingroup::findByPK($ingroup['id']);
        $ing->fill($ingroup)
            ->save();

        $this->redirect('/Ingroups/');
    }
    
    public function actionOne($id=1)
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



        $this->data->item = $item;
    }

    public function actionEuLister($id=1)
    {
        $item=Ingroup::findByPK($id);
        foreach ($item->inpercents as $line)
        {
            $line->title = $line->inname->inNameEu;
        };


        $item2 = $item->inpercents->sort(function(Inpercent $x1, Inpercent $x2){ return ((int)$x1->ordering <=> (int)$x2->ordering); });

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ' (and) ');

        $this->data->listing = $listString;
    }

    public function actionUsLister($id=1)
    {
        $item=Ingroup::findByPK($id);
        foreach ($item->inpercents as $line)
        {
            $line->title = $line->inname->inNameUs;
        };

        $listArray = $item->inpercents->collect('title');
        $listString =implode($listArray, ' (and) ');

        $this->data->listing = $listString;
    }


}