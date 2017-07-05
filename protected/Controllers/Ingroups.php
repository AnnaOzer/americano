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
        $items = Ingroup::findAll(['order'=>'title']);
        
        foreach ($items as $item) {
            $item->eu = $item->EuLister($item->getPk());
            $item->us = $item->UsLister($item->getPk());
        }
        
        
        $this->data->items = $items;
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
            $this->redirect('/Raws/');
        }
        $item->inpercents;

        foreach ($item->inpercents as $line)
        {
            $line->inname;
        }

        $this->data->item = $item;
    }

   /*
    public function actionEuLister($id)
    {
        $item=Ingroup::findByPK($id);
       // $item->inpercents;

        foreach ($item->inpercents as $line)
        {
            $line->title = $line->inname->inNameEu;

        };

        $item2 = $item->inpercents->sort(function(Inpercent $x1, Inpercent $x2){ return ((int)$x1->ordering <=> (int)$x2->ordering); });

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ' (and) ');

        $this->data->listing = $listString;
        

    }

    public function actionUsLister($id)
    {
        $item=Ingroup::findByPK($id);
        foreach ($item->inpercents as $line)
        {
            $line->title = $line->inname->inNameUs;
        };

        $item2 = $item->inpercents->sort(function(Inpercent $x1, Inpercent $x2){ return ((int)$x1->ordering <=> (int)$x2->ordering); });

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ' (and) ');

        $this->data->listing = $listString;
    }

*/
    public function actionRawULister($id)
    {
        $item = Ingroup::findByPK($id);
        $item->raws;

        $this->data->item = $item;
    }


    public function actionProductsLister($id)
    {
        $item = Ingroup::findByPK($id);
        $item->raws;

        foreach( $item->raws as $raw) {
            $raw->rawpercents;
            
            foreach ($raw->rawpercents as $rawpercent) {
                $rawpercent->product;
            }
        }

        $this->data->item = $item;
    }
    
    public function actionNamesLister() {
        
        $this->data->items = Ingroup::findAll(['order'=>'title']);
        
    }
}