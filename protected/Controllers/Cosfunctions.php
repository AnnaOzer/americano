<?php

namespace App\Controllers;

use App\Models\Cosfunction;
use T4\Mvc\Controller;

class Cosfunctions
    extends Controller
{

    public function actionDefault()
    {
        $this->data->items = \App\Models\Cosfunction::findAll(['order'=>'titleEng']);
    }

    public function actionCreate()
    {
        
    }

    public function actionSave($cosfunction)
    {
        $item=
            (new Cosfunction())
                ->fill($cosfunction)
                ->save();

        $this->redirect('/Cosfunctions/');
    }

    public function actionDelete($id)
    {
        $item=Cosfunction::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Cosfunctions/');
    }

    public function actionUpdate($id)
    {
        $item = Cosfunction::findByPK($id);
        $this->data->item = $item;
    }

    public function actionUpdatesave($cosfunction)
    {
        $ing = Cosfunction::findByPK($cosfunction['id']);
        $ing->fill($cosfunction)
            ->save();

        $this->redirect('/Cosfunctions/');
    }

    public function actionOne($id=1)
    {
        $item=Cosfunction::findByPK($id);
        if(empty($item)) {
            $this->redirect('/Cosfunctions/');
        }
        
        $this->data->item = $item;
    }


}