<?php

namespace App\Controllers;

use App\Components\Intervaler;
use App\Models\Product;
use App\Models\Rawpercent;
use App\Models\Inpercent;
use T4\Mvc\Controller;

class Eu
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionOne($id)
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

    public function actionOnePrint($id)
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


}