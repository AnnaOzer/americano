<?php

namespace App\Controllers;

use App\Models\Buyrawjournal;
use App\Models\Ingroup;
use T4\Mvc\Controller;

class Buyrawjournals
    extends Controller
{

    public function actionDefault()
    {
        $items = Buyrawjournal::findAll(['order'=>'whenbought']);


        foreach($items as $item) {


            $item->ingroup;
        }

        $this->data->items = $items;

    }

    public function actionCreate()
    {

    }

    public function actionSave($buyrawjournal)
    {
        $item =
            (new Buyrawjournal())
                ->fill($buyrawjournal)
                ->save();

        $this->redirect('/Buyrawjournals/');
    }


    public function actionUpdate($id)
    {
        $item = Buyrawjournal::findByPK($id);
        $this->data->item = $item;

    }

    public function actionUpdatesave($buyrawjournal)
    {
        $item = Buyrawjournal::findByPK($buyrawjournal[id]);

        $item

            ->fill($buyrawjournal)
            ->save();

        $this->redirect('/Buyrawjournals/');
    }

    public function actionDelete($id)
    {
        $item=Buyrawjournal::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Buyrawjournals/');
    }

    public function actionChangeingroup($id)
    {
        $item = Buyrawjournal::findByPk($id);
        $this->data->item = $item;

        $mainnames = Ingroup::findAll(['order'=>'title']);
        $this->data->mainnames = $mainnames;

    }

    public function actionChangeingroupsave($buyrawjournal, $ingroup){
        $group = Ingroup::findByPk($ingroup['id']);
        $group->buyrawjournals->add(Buyrawjournal::findByPk($buyrawjournal['id']));
        $group->save();

        $this->redirect("/Buyrawjournals/");
    }

    public function actionOnerecent($ingroup_id)
    {
        $item = Buyrawjournal::find(['where' => '__ingroup_id='. $ingroup_id, 'limit'=>'1', 'order by'=>'whenbought']);
    }
}
