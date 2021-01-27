<?php

namespace App\Controllers;

use App\Components\Intervaler;
use App\Models\Product;
use App\Models\Products;
use App\Models\Raw;
use App\Models\Rawpercent;
use App\Models\Premix;
use App\Models\Premixinproduct;
use T4\Mvc\Controller;
use App\Models\Buyrawjournal;

class Products
    extends Controller
{
    
    public function actionDefault()
    {
        $this->data->items = \App\Models\Product::findAll();
        

    }

    public function actionDetails()
    {
        $this->data->items = \App\Models\Product::findAll();
        
    }
    
    public function actionCreate()
    {
        
    }

    public function actionSave($product)
    {
        $item=
            (new Product())
            ->fill($product)
            ->save();
        
        $this->redirect('/Products/');
    }


    public function actionUpdate($id)
    {
        $item = Product::findByPK($id);
        $this->data->item = $item;
    }

    public function actionUpdatesave($product)
    {
        $ing = Product::findByPK($product['id']);
        $ing->fill($product)
            ->save();

        $this->redirect('/Products/');
    }

    public function actionDelete($id)
    {
        $item=Product::findByPk($id);
        if(!empty($item)) {
            $item->delete();
        }
        $this->redirect('/Products/');
    }

    public function actionOne($id)
    {
        $item = Product::findByPK($id);
        if (empty($item)) {
            $this->redirect('/Products/');
        }
        
        // сырье
        if (0 != $item->rawpercents) {

        $item->rawpercents = $item->rawpercents->sort(
                function ($x1, $x2) {
                    return $x2->percent <=> $x1->percent;
                }
            );
        }
        foreach ($item->rawpercents as $line)
        {
            $line->raw;
        }
        
        // повторить для премиксов
        /* cut1
        if (0 != $item->premixinproducts) {

            $item->premixinproducts = $item->premixinproducts->sort(
                function ($x1, $x2) {
                    return $x2->percent <=> $x1->percent;
                }
            );
        }

        foreach ($item->premixinproducts as $line)
        {
            $line->premix;
        }
        
        cut1 */
        
        $sum=0;
        
        // сырье
        foreach ($item->rawpercents as $rawpercent)
        {
            $sum+=$rawpercent->percent;
        }

        // повторить для премиксов
        foreach ($item->rawpercents as $rawpercent)
        {
            $sum+=$rawpercent->percent;
        }
        
        
        $item->sumPercent =$sum;
        $item->freePercent = 100000-$sum;
        

        $this->data->item = $item;

        
    }


    public function actionOneprice($id)
    {
        $item = Product::findByPK($id);
        if (empty($item)) {
            $this->redirect('/Products/');
        }

        // сырье
        if (0 != $item->rawpercents) {

            $item->rawpercents = $item->rawpercents->sort(
                function ($x1, $x2) {
                    return $x2->percent <=> $x1->percent;
                }
            );
        }
        foreach ($item->rawpercents as $line)
        {

                $line->raw->ingroup->recentbuyrawjournal = Buyrawjournal::find([
                    'where' => '__ingroup_id='. $line->raw->ingroup->getPk(),
                    'order by'=>'whenbought',
                    'limit'=>'1'
                ]);
        }



        $sum=0;
        $sumeuro=0;

        // сырье
        foreach ($item->rawpercents as $rawpercent)
        {
            $sum+=$rawpercent->percent;
            $rawpercent->euroimpact=
                $rawpercent->percent * $rawpercent->raw->ingroup->recentbuyrawjournal->priceeuro/100000;
            $sumeuro+=$rawpercent->euroimpact;
        }



        $item->sumPercent =$sum;
        $item->freePercent = 100000-$sum;

        $item->sumeuro=$sumeuro;


        $this->data->item = $item;


    }

    public function actionSingle($id){

    }


    public function actionOnepremix($id){
        $item=Product::findByPK($id);
        if(empty($item)) {
            $this->redirect('/Products/');
        }
        $item->sumPercent = 0;
        $item->freePercent = 100000;

        if (0 != $item->premixrawpercents) {
            $item->premixrawpercents = $item->premixrawpercents->sort(
                function ($x1, $x2) {
                    return $x2->percent <=> $x1->percent;
                }
            );


            foreach ($item->premixrawpercents as $line) {
                $line->raw;
            }

            $sum = 0;
            foreach ($item->premixrawpercents as $premixrawpercent) {
                $sum += $premixrawpercent->percent;
            }
            $item->sumPercent = $sum;
            $item->freePercent = 100000 - $sum;
        }

        $this->data->item = $item;


    }


    public function actionAdd($id)
    {
        $product = Product::findByPK($id);
        $raws = Raw::findAll(['order'=>'title']);
        $this->data->product = $product;
        $this->data->raws = $raws;
    }
    
    public function actionAddrawsave($id, $rawpercent)
    {
        $product = Product::findByPK($id);
        $product->rawpercents->add(new Rawpercent($rawpercent))
        ->save();
        $this->redirect('/Products/One/?id='.$id);
    }
    
    public function actionClone($id)
    {
        $product = Product::findByPK($id);
        $product->rawpercents;
        $product1 = $product;
        $product1->labName = 'CLONE of ' . $product->labName;
        $product1->rusName = 'CLONE of ' . $product->rusName;
        $product1->engName = 'CLONE of ' . $product->engName;

        $item=
            (new Product())
                ->fill($product1)
                ->save();
        
        foreach ($product->rawpercents as $rawpercent) {

            unset ($rawpercent1);
            $rawpercent1 = $rawpercent;
            $rawpercent1->__product_id = $item->getPk();
            unset ($rawpercent1->__id);


            $itemer =
                (new Rawpercent())
                ->fill($rawpercent)
                ->save();
            
        }

        $this->redirect('/Products/One/?id=' . $item->getPk());
    }
    
   

    /*
    public function actionDeclaratorEu($id=1)
    {
        $item = Product::findByPK($id);
        
        $item->rawpercents;
        foreach ($item->rawpercents as $rawpercent)
        {
            $rawpercent->raw->ingroup;
            $rawpercent->raw->ingroup->interval
                =(new Intervaler($rawpercent->percent))->StandartIntervaler($this->percentage);
        }

        $item->rawpercents = $item->rawpercents->sort(function($x1, $x2) {
            return 
                $x1->raw->ingroup->interval->order <=> $x2->raw->ingroup->interval->order;
        });

        $inhaltsEu=[];
        $inhaltsUs=[];
        $inhaltsRu=[];

        foreach ($item->rawpercents as $rawpercent)
        {
            $ingroupPk = $rawpercent->raw->ingroup->getPk();
            $inhaltsEu[] = $rawpercent->raw->ingroup->EuLister($ingroupPk);
            $inhaltsUs[] = $rawpercent->raw->ingroup->UsLister($ingroupPk);
            $inhaltsRu[] = $rawpercent->raw->ingroup->RuLister($ingroupPk);
        }

        $item->inhaltsEu = implode($inhaltsEu, ', ');
        $item->inhaltsUs = implode($inhaltsUs, ', ');
        $item->inhaltsRu = implode($inhaltsRu, ', ');
        
        $this->data->item = $item;
              
    }

    public function actionDeclaratorUs($id=1)
    {
        $item = Product::findByPK($id);
        $item->rawpercents;
        foreach ($item->rawpercents as $rawpercent)
        {

            $rawpercent->raw->ingroup;

            $rawpercent->raw->ingroup->interval
                =(new Intervaler($rawpercent->percent))->StandartIntervaler($this->percentage);
        }


        $item->rawpercents = $item->rawpercents->sort(function($x1, $x2) {
            return
                $x1->raw->ingroup->interval->order <=> $x2->raw->ingroup->interval->order;
        });

        $this->data->item = $item;

    }

    public function actionDeclaratorRu($id)
    {
        $item = Product::findByPK($id);
        $item->rawpercents;
        foreach ($item->rawpercents as $rawpercent) {

            $rawpercent->raw->ingroup;

            $rawpercent->raw->ingroup->interval
                = (new Intervaler($rawpercent->percent))->StandartIntervaler($this->percentage);
        }

        $item->rawpercents = $item->rawpercents->sort(function ($x1, $x2) {
            return $x1->raw->ingroup->interval->order <=> $x2->raw->ingroup->interval->order;
        });


        $this->data->item = $item;
    }
*/
    
}

