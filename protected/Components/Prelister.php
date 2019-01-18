<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 18.11.2016
 * Time: 10:48
 */

namespace App\Components;
use \App\Components\Megaproduct;
use \App\Models\Product;
use T4\Core\Std;
use T4\Core\Collection;


class Prelister
{
    public static function Prelister($id, $reg='eu')
    {
        $item = Megaproduct::Builder($id);
        $p_productId = $item->getPk();
        $prelisters = [];

        foreach ($item->rawpercents as $rawpercent) {

            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {
                $x = [];

                $x['inci_id'] = $inpercent->inname->getPk();
                
                if ('us'==$reg) {
                    $x['inci_name'] = $inpercent->inname->inNameUs;
                } else {
                    $x['inci_name'] = $inpercent->inname->inNameEu;
                }

                $x['casNumber'] = $inpercent->inname->casNumber;
                $x['ecNumber'] = $inpercent->inname->ecNumber;




                $x['inci_perc'] = $rawpercent->percent * $inpercent->percent / 100000000;


                foreach ($item->productinciorders as $productinciorder) {

                    if ($productinciorder->inname->getPk() == $inpercent->inname->getPk() )
                    $x['whyAdded'] = $productinciorder->whyAdded;
                }


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
                $prelisters[$x['inci_id']]['casNumber'] = $x['casNumber'];
                $prelisters[$x['inci_id']]['ecNumber'] = $x['ecNumber'];
                $prelisters[$x['inci_id']]['whyAdded'] = $x['whyAdded'];



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
        
        $data=new Std();
        $data->item = $item;
        $data->preingredients = $item->preingredients;
        $data->sprelisters = $sprelisters;

        $data->slist = implode($sprelisters->collect('inname'), ', ');
        
        return $data;
    }
}
    