<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 05.07.2017
 * Time: 18:24
 */

namespace App\Components;
use \App\Models\Product;
use App\Models\Rawpercent;
use App\Models\Inpercent;
use T4\Core\Collection;
use T4\Core\Std;

class Megainci
{
    public static function Builder($id)
    {
        $item = Megaproduct::Builder($id);
        $item->productinciorders;

        //$lister = new Collection();
        $lister = [];
        $i = 0;
        foreach ($item->rawpercents as $rawpercent){
            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent){

                $addenda = [
                    'num' => ++$i,
                    'inname' => $inpercent->inname,
                    'ipercent' => $inpercent->percent,
                    'rpercent' => $rawpercent->percent,
                    'fpercent' => $inpercent->percent*$rawpercent->percent/100000,
                ];

                //$lister->add($addenda);
                $lister[]=$addenda;
            }
        }
/*
        $cumul = [];
        foreach ($lister as $line) {
            if ()
        }
*/


        return $lister;
   
    }
}