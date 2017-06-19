<?php

namespace App\Controllers;

use App\Components\Intervaler;
use App\Models\Product;
use App\Models\Rawpercent;
use T4\Mvc\Controller;

class Eu
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionOne($id)
    {
        $item = Product::findByPK($id);
        
        foreach ($item->rawpercents as $rawpercent) {
            
            $listFunctions = []; // temp functions

            $rawpercent->raw->ingroup->inpercents;

            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {

                $inpercent->inname;

                // starts temp functions   
                    
                foreach ($inpercent->inname->cosfunctionincis as $cosfunctioninci) {

                    $listFunctions[] = $cosfunctioninci->cosfunction->titleEng;
                    
                }
                // ends temp functions

            }
            
            $rawpercent->intervalpercent = (new Intervaler())->StandartIntervaler($rawpercent->percent);
            $rawpercent->listFunctions = implode($listFunctions, ', ');

        }

        $item->rawpercents = $item->rawpercents->sort(
            function (Rawpercent $x1, Rawpercent $x2) {
                return $x2->percent <=> $x1->percent;
            }
        );

        $this->data->item = $item;
        
    }

}