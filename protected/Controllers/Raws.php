<?php

namespace App\Controllers;

use App\Models\Ingroup;
use App\Models\Raw;
use T4\Mvc\Controller;

class Raws
    extends Controller
{

    public function actionDefault()
    {
        $items=Raw::findAll(['order'=>'title']);

        foreach ($items as $item) {
            $item->ingroup1=$item->ingroup->title;
        }
        $this->data->items = $items;


    }

    public function actionChangesyn($id){
        $item = Raw::findByPk($id);
        $this->data->item = $item;

        $mainnames = Ingroup::findAll(['order'=>'title']);

        $this->data->mainnames = $mainnames;
    }

    public function actionChangesynsave($raw, $ingroup){
        $group = Ingroup::findByPk($ingroup['id']);
        $group->raws->add(Raw::findByPk($raw['id']));
        $group->save();

        $this->redirect("/Raws/");
    }

    public function actionCreate()
    {
        
        $defaultIngroup = Ingroup::findByColumn('title','Не определено');
        $this->data->defaultIngroup = $defaultIngroup;
    }

    public function actionSave($raw)
    {
        $item=
            (new Raw())
                ->fill($raw)
                ->save();

        $this->redirect('/Raws/');
    }

    public function actionOne($id=1)
    {
        $item = Raw::findByPk($id);
        $item->ingroup1=$item->ingroup->title;
        $this->data->item =  $item;

    }

    public function actionUpdate($id)
    {
        $item = Raw::findByPK($id);
        $this->data->item = $item;
        
    }


    public function actionUpdatesave($raw)
    {

        $item = Raw::findByPK($raw["id"]);
        $item->fill($raw)->save();

        $this->redirect('/Raws/');

    }

    public function actionDelete($id)
    {
        $item=Raw::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Raws/');
    }

    public function actionWhere($id)
    {
        $item = Raw::findByPk($id);
        $item->rawpercents;
        $item->ingroup->raws;

        foreach ($item->rawpercents as $rawpercent) {
            $rawpercent->product;
        }

        $this->data->item = $item;
    }
    
}