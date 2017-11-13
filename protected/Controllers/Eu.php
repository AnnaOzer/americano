<?php

namespace App\Controllers;

use App\Components\Intervaler;
use App\Components\Megainci;
use App\Models\Product;
use App\Models\Productinciorder;
use App\Models\Rawpercent;
use App\Models\Inpercent;
use T4\Core\Collection;
use T4\Core\Std;
use T4\Mvc\Controller;
use App\Components\Megaproduct;

class Eu
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionOne($id)
    {
        $this->data->item = Megaproduct::Builder($id);
       
    }

    public function actionOneInci($id)
    {
        $this->data->lister = Megainci::Builder($id);
    }
    
    public function actionOnePrint($id, $mode='')
    {
        /*
        if ('pdf' == $mode) {
            $data = Megaproduct::Builder($id);
            $path = __DIR__ . DS . 'test' . DS . testhtml;
            $template = 'OnePrint.html';
            $page = $this->view->render($template, $data);
            file_put_contents($path.'.html', $page);
            exec('"C:\Server\OpenServer\bin\wkhtmltopdf\bin\wkhtmltopdf.exe" '.$path.'.html '.$path.'.pdf');
            @unlink($path.'.html');
            $file = $path.'.pdf';
            header("Content-type: application/pdf");
            header("Content-Disposition: filename=Putevoi_");
            readfile($file);
            @unlink($file);
            exit;
        } else {
        */
        $this->data->item = Megaproduct::Builder($id);
        //}

    }
    
    public function actionOnePreingredients($id)
    {
        $item = Megaproduct::Builder($id);
        $p_productId = $item->getPk();
        $prelisters = [];

        foreach ($item->rawpercents as $rawpercent){

            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {
                $x=[];

                $x['inci_id'] = $inpercent->inname->getPk();
                $x['inci_name'] = $inpercent->inname->inNameEu;

                $x['inci_perc'] = $rawpercent->percent * $inpercent->percent /100000000;

                //$productinciorders = $inpercent->inname->productinciorders;


                /*
                               $productinciorders ->filter(
                                   function (Productinciorder $x) {
                                       return $x->product->getPk() == $item->getPk();
                                   }
                               );

                               var_dump($productinciorders);
                               */
                foreach ($inpercent->inname->productinciorders as $productinciorder) {

                    $i_productId = $productinciorder->product->getPk();
                    $inci_order = NULL;
                    if ($p_productId == $i_productId) {
                        $x['inci_order'] = $productinciorder->order;
                    }
                }

                
                $prelisters[$x['inci_id']]['inperc'] += $x['inci_perc'];
                $prelisters[$x['inci_id']]['inname'] = $x['inci_name'];
                $prelisters[$x['inci_id']]['inorder'] = $x['inci_order'];
                $prelisters[$x['inci_id']]['inciid'] = $x['inci_id'];

                $sprelisters[$x['inci_id']]['inorder'] = $x['inci_order'];
                $sprelisters[$x['inci_id']]['inperc'] += $x['inci_perc'];
                $sprelisters[$x['inci_id']]['inname'] = $x['inci_name'];
                $sprelisters[$x['inci_id']]['inciid'] = $x['inci_id'];
                
            }
        }

        arsort($prelisters);
        asort($sprelisters);
        $sprelisters = new Collection($sprelisters);




        $item->prelisters = $prelisters;
        $this->data->item = $item;
        $this->data->preingredients = $item->preingredients;
        $this->data->sprelisters = $sprelisters;

        $this->data->slist = implode($sprelisters->collect('inname'), ', ');
    }
/*
    public function actionOneInci($id)
    { 
        $item = Megaproduct::Builder($id);
        foreach ($item->rawpercents as $rawpercent){

            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {

                $inci_id = $inpercent->inname->getPk();
                $inci_name = $inpercent->inname->inNameEu;

                $inci_perc = $rawpercent->percent * $inpercent->percent /100000000;

                $prelisters[$inci_id]['inperc'] += $inci_perc;
                $prelisters[$inci_id]['inname'] = $inci_name;


            }
        }

        arsort($prelisters);



        $item->prelisters = $prelisters;
        $this->data->item = $item;
    }
   */
    public function actionOneOldTemp($id)
    {
        // get product by Pk
        $item = Product::findByPK($id);
        
        // 
        foreach ($item->rawpercents as $rawpercent) {

            if ( -1 == $rawpercent->decomposition ) {
                unset ($rawpercent);
                continue;
            }
            
            $listFunctions = []; // temp functions

            $rawpercent->raw->ingroup->inpercents = $rawpercent->raw->ingroup->inpercents->sort(
                function (Inpercent $x1, Inpercent $x2) {
                    return $x1->ordering <=> $x2->ordering;
                }
            );

            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {

                $inpercent->inname;

                // starts temp functions   
                    
                foreach ($inpercent->inname->cosfunctionincis as $cosfunctioninci) {

                    $listFunctions[] = $cosfunctioninci->cosfunction->titleEng;
                    
                }
                // ends temp functions

            }
            

            

            // get some string info about an ingroup concentration in Formulation
            if ( $rawpercent->raw->ingroup->exactValue ) {
                // get exact string values for specific ingroups instead of string intervals
                $rawpercent->intervalpercent = (new Intervaler())->ExactIntervaler($rawpercent->percent);
            } else {
                // get string interval for percentage
                $rawpercent->intervalpercent = (new Intervaler())->StandartIntervaler($rawpercent->percent);
            }
            
            
            // get lest of possible functions for preview
            $rawpercent->listFunctions = implode($listFunctions, ', ');

        }
        
        
        if (0 === $item->manualOrderingOn) {
            
            // sort by real percentage    
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {
                    return $x2->percent <=> $x1->percent;
                }
            );
        }

        if (1 == $item->manualOrderingOn) {

            // sort by manual ordering    
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {
                    return $x1->manualOrder <=> $x2->manualOrder;
                }
            );
        }

        // start temp
        $listIng = [];
        $orderIng = 0;

        foreach ($item->rawpercents as $rawpercent) {

            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {

                $listIng[] = [++$orderIng, $inpercent->inname->inNameEu];
            }
        }
        // end temp

        $this->data->item = $item;
        
    }

    public function actionOnePrintOldTemp($id)
    {
    // get product by Pk
        $item = Product::findByPK($id);

        //
        foreach ($item->rawpercents as $rawpercent) {

            if ( -1 == $rawpercent->decomposition ) {
                unset ($rawpercent);
                continue;
            }

        $listFunctions = []; // temp functions

            $rawpercent->raw->ingroup->inpercents = $rawpercent->raw->ingroup->inpercents->sort(
                function (Inpercent $x1, Inpercent $x2) {
                    return $x1->ordering <=> $x2->ordering;
                }
            );

        foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {

            $inpercent->inname;

            // starts temp functions

            foreach ($inpercent->inname->cosfunctionincis as $cosfunctioninci) {

                $listFunctions[] = $cosfunctioninci->cosfunction->titleEng;

            }
            // ends temp functions

        }




        // get some string info about an ingroup concentration in Formulation
        if ( $rawpercent->raw->ingroup->exactValue ) {
            // get exact string values for specific ingroups instead of string intervals
            $rawpercent->intervalpercent = (new Intervaler())->ExactIntervaler($rawpercent->percent);
        } else {
            // get string interval for percentage
            $rawpercent->intervalpercent = (new Intervaler())->StandartIntervaler($rawpercent->percent);
        }


        // get lest of possible functions for preview
        $rawpercent->listFunctions = implode($listFunctions, ', ');

        }


        if (0 === $item->manualOrderingOn) {

            // sort by real percentage
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {
                    return $x2->percent <=> $x1->percent;
                }
            );
        }

        if (1 == $item->manualOrderingOn) {

            // sort by manual ordering
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {
                    return $x1->manualOrder <=> $x2->manualOrder;
                }
            );
        }


        $this->data->item = $item;

        }

    public function actionOneIngredients($id)
    {
        
      
    } 
}