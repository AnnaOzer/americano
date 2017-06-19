<?php

namespace App\Controllers;

use App\Models\Cosfunction;
use App\Models\Cosfunctioninci;
use App\Models\Inname;
use T4\Mvc\Controller;

class Cosfunctionincis
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionAdd($id)
    {
        $inname = Inname::findByPK($id);
        $cosfunctions = Cosfunction::findAll(['order' => 'titleEng']);
        $this->data->inname = $inname;
        $this->data->cosfunctions = $cosfunctions;
        
    }


    
    public function actionAddSave($cosfunctioninci)
    {
        $innamePk = $cosfunctioninci['__inname_id'];

        $item =
            (new Cosfunctioninci())
                ->fill($cosfunctioninci)
                ->save();

        $this->redirect('/Innames/One?id='. $innamePk);
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
        $item=Cosfunctioninci::findByPk($id);




        if(!empty($item)) {

            $innamePk = $item->__inname_id;
            $item->delete();

            $this->redirect('/Innames/One?id='. $innamePk);

        }
        $this->redirect('/Innames/');
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