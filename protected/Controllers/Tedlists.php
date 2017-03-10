<?php

namespace App\Controllers;

use App\Components\Intervaler;
use App\Models\Product;
use T4\Core\Collection;
use T4\Mvc\Controller;

class Tedlists
    extends Controller
{

    public function actionDefault()
    {

    }
    
    public function actionEuOneBack($id)
    {
        $item = Product::findByPK($id);
        $item->rawpercents;

        $table = new Collection();

        foreach ($item->rawpercents as $v) {
            
            unset($a);
            $a=new Collection();
            $a->percent = $v->percent;
            
            $v->raw;
            $v->raw->ingroup;
            $v->raw->ingroup->inpercents;
            
            foreach ($v->raw->ingroup->inpercents as $w) {
                 
                 $a->inpercent = $w->percent;
                 $a->inname = $w->inname->inNameEu;

                 $table->add($a);

            }
        }

        foreach ($table as $key=>$value) {
            $table[$key]->multpercent = $value->percent * $value->inpercent / 100000;
        }

        $tableGroup = $table->group('inname');

        $tableSum = [];
        foreach ($tableGroup as $k => $v) {

            $line=[];

            $line['multsumpercent'] = 0;

            foreach ($v as $w) {

                $line['inname'] = $w->inname;
                $line['multsumpercent'] += $w->multpercent;

            }

            $line['multsumpercentreal'] = $line['multsumpercent']/1000;

            $line['multsuminterval'] = Intervaler::StandartIntervaler($line['multsumpercent'])['interval'];
            
            $line['multsumorder'] = Intervaler::StandartIntervaler($line['multsumpercent'])['order'];
           

            $tableSum[]=$line;
        }





        $tableSumColl = new Collection($tableSum);
        $tableOrder = $tableSumColl->sort(
            function ($a, $b) {

                return ($b['multsumpercentreal'] <=> $a['multsumpercentreal']);
            }
        );

        

        $tableList = $tableOrder->collect('inname');
        
        $tableLister = strtoupper(implode($tableList, ', '));

        $this->data->product = $item;
        $this->data->item = $tableOrder;
        $this->data->list = $tableLister;
        

        
    }

    public function actionEuOneSheet($id)
    {

    }
    
}