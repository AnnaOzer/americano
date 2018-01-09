<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 05.07.2017
 * Time: 18:04
 */

namespace App\Components;

use \App\Models\Product;
use App\Models\Rawpercent;
use App\Models\Inpercent;


class Megaproduct
{
    public static function Builder($id) {
        // get product by Pk
        $item = Product::findByPK($id);

        // 
        foreach ($item->rawpercents as $rawpercent) {

            // remove certain bad-looking conponents
            if ( -1 == $rawpercent->decomposition ) {
                unset ($rawpercent);
                continue;
            }

            $listFunctions = []; // temp functions

            // sort incis inside each raw
            $rawpercent->raw->ingroup->inpercents = $rawpercent->raw->ingroup->inpercents->sort(
                function (Inpercent $x1, Inpercent $x2) {
                    return $x1->ordering <=> $x2->ordering;
                }
            );

            // see inci object and its all possible functions
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


            // get list of possible functions for preview
            $rawpercent->listFunctions = implode($listFunctions, ', ');

        }


        if (0 === $item->manualOrderingOn) {

            // sort by real percentage    
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x2, Rawpercent $x1) {

                    return $x1->percent <=> $x2->percent;
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

        
        

                return $item;
    }
}