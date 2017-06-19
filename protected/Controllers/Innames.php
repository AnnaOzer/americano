<?php

namespace App\Controllers;

use App\Models\Ingroup;
use App\Models\Inname;
use App\Models\Raw;
use T4\Mvc\Controller;

class Innames
    extends Controller
{

    public function actionDefault()
    {
        $items=Inname::findAll(['order'=>'inNameEu']);
        $this->data->items = $items;


    }




    public function actionCreate()
    {

    }

    public function actionSave($inname)
    {
        $item=
            (new Inname())
                ->fill($inname)
                ->save();

        $this->redirect('/Innames/');
    }

    public function actionOne($id=1)
    {
        $item = Inname::findByPk($id);
        $item->ingroup;
        $this->data->item =  $item;

    }

    public function actionUpdate($id)
    {
        $item = Inname::findByPK($id);
        $this->data->item = $item;
        
    }
    
    public function actionUpdatesave($inname)
    {
        $item = Inname::findByPK($inname['id']);
        $item
            ->fill($inname)
            ->save();

        $this->redirect('/Innames/');
    }

    public function actionDelete($id)
    {
        $item=Inname::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Innames/');
    }


    public function actionCosfunctionsLister($id)
    {
        $item = Inname::findByPK($id);
        $item->cosfunctionincis;

        foreach( $item->cosfunctionincis as $line) {
            $line->cosfunction;
        }

        $this->data->item = $item;
    }

    public function actionUpdateFunctions($id)
    {
        $item = Inname::findByPK($id);
        
        if(empty($item)) {
            $this->redirect('/Innames/');
        }

        $item->cosfunctionincis;

        foreach ($item->cosfunctionincis as $line)
        {
            $line->cosfunction;
        }
        

        $this->data->item = $item;

    }

    public function actionIngroupsLister($id)
    {
        $item = Inname::findByPK($id);
        $item->inpercents;

        foreach( $item->inpercents as $line) {
            $line->ingroup;
        }

        $this->data->item = $item;
    }
}

