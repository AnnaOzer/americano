<?php

namespace App\Models;

use T4\Core\Collection;
use T4\Core\Config;
use T4\Core\Std;
use T4\Orm\Model;

class Product
    extends Model
{
    static protected $schema=[
        'columns'=>[
            'labName'=>['type'=>'string'],
            'rusName'=>['type'=>'string'],
            'engName'=>['type'=>'string'],
            'dateSigned'=>['type'=>'date'],
            'manualOrderingOn'=>['type'=>'int'],
                       
            

            'volume'=>['type'=>'string'],
            'volumeEng'=>['type'=>'string'],
            
            'for'=>['type'=>'string'],
            'forEng'=>['type'=>'string'],
            
            'bantiki'=>['type'=>'string'],
            'bantikiEng'=>['type'=>'string'],
            
            'how'=>['type'=>'string'],
            'howEng'=>['type'=>'string'],
            
            'shortdesc'=>['type'=>'text'], 
            'shortdescEng'=>['type'=>'text'],
            
            
            'danger'=>['type'=>'string'],
            'dangerEng'=>['type'=>'string'],

            'description'=>['type'=>'text'],
            'descriptionEng'=>['type'=>'text'],
            
            'ordering'=>['type'=>'int'],
            'orderingTable'=>['type'=>'int'],
            
            'listRus'=>['type'=>'text'],

            'bestbefore'=>['type'=>'text'],
            'bestbeforeEng'=>['type'=>'text'],
            
            'manualProductinciorder'=>['type'=>'int']
        ],
        
        'relations'=> [
            'rawpercents'=>[
                'type'=>self::HAS_MANY,
                'model'=>Rawpercent::class,
            ],
            'seria'=> [
                'type'=>self::BELONGS_TO,
                'model'=>Seria::class,
            ],
            'upak'=> [
                'type'=>self::BELONGS_TO,
                'model'=>Upak::class,
            ],
            'productinciorders'=>[
                'type'=>self::HAS_MANY,
                'model'=>Productinciorder::class,
            ],
            'typeofreceptures'=>[
                'type'=>self::BELONGS_TO,
                'model'=>Typeofrecepture::class,
            ],
            'premixinproducts'=>[
                'type'=>self::HAS_MANY,
                'model'=>Premixinproduct::class,
            ],
           
        ]
    ];
    
    
    

    public function EuInhaltsOld($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $line)
        {
            if (!empty($ingroupId = $line->raw->ingroup))
            {
                $ingroupId = $line->raw->ingroup->getPk();
                $line->title = $line->raw->ingroup->EuLister($ingroupId);
                $line->interval = $line->StandartInterval($line->percent);
                $line->orderby = $line->interval['order'];
                $line->priorityby = $line->raw->ingroup->priority;

            }
            else {
                var_dump($line); die;
        }

        }

        if(0==$item->manualOrderingOn) {
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {

                    if ($x1->orderby > 2 || $x2->orderby > 2) {
                        if ((int)$x1->orderby !== (int)$x2->orderby) {
                            return ($x2->orderby <=> $x1->orderby);
                        } else {
                            return ($x1->priorityby <=> $x2->priorityby);
                        }

                    } else {
                        return ($x1->priorityby <=> $x2->priorityby);
                    }

                }
            );
        } elseif (1==$item->manualOrderingOn) {
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {


                        return ($x1->manualOrder <=> $x2->manualOrder);

                }
            );
        }





        $listArray = $item->rawpercents->collect('title');
        $listString =implode($listArray, ', ');

        return $listString;

    }


    public function MultiInhalts($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $rawpercent) {

            foreach ($rawpercent->raw->ingroup->inpercents as $inpercent) {


                $multpercent = $inpercent->percent * $rawpercent->percent / 100000;

                $line[]=['inNameEu'=>$inpercent->inname->inNameEu,
                    'inNameUs'=>$inpercent->inname->inNameUs,
                    'multpercent'=>$multpercent, ];
            }
        }


        return new Collection($line);
    }




    public function PreEuInhalts($id){

        $multiInhalts=$this->MultiInhalts($id);
        
        $distinctInhalts = $multiInhalts->group('inNameEu');

        foreach ($distinctInhalts as $key => $distinctInhalt) {
            $v = 0;
            foreach ($distinctInhalt as $oneInhalt) {
                $v+= $oneInhalt['multpercent'];
            }
            $distinctInhalts[$key]['sum'] = $v;
        }


        $distinctInhalts=new Collection($distinctInhalts);

        foreach ($distinctInhalts as $distinctInhalt)
        {
            var_dump($distinctInhalt['sum']);
            echo '<br>';
        }


        $distinctInhalts->sort(

            function ($x1, $x2) {

                return $x2['sum'] <=> $x1['sum'];

            });

        var_dump($distinctInhalts);

        return $distinctInhalts;


    }

    public function EuInhalts($id) {

        $pres = $this->PreEuInhalts($id);




    }

    public function UsInhalts($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $line)
        {
            if (!empty($ingroupId = $line->raw->ingroup))
            {
                $ingroupId = $line->raw->ingroup->getPk();
                $line->title = $line->raw->ingroup->UsLister($ingroupId);
                $line->interval = $line->StandartInterval($line->percent);
                $line->orderby = $line->interval['order'];
                $line->priorityby = $line->raw->ingroup->priority;

            }
            else {
                var_dump($line); die;
            }

        }

        if (1==$item->manualOrderingOn) {
            $item->rawpercents = $item->rawpercents->filter(
                function (Rawpercent $x) {
                    return $x->manualOrder != 0;
                });
        }

        if(0==$item->manualOrderingOn) {
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {

                    if ($x1->orderby > 2 || $x2->orderby > 2) {
                        if ((int)$x1->orderby !== (int)$x2->orderby) {
                            return ($x2->orderby <=> $x1->orderby);
                        } else {
                            return ($x1->priorityby <=> $x2->priorityby);
                        }

                    } else {
                        return ($x1->priorityby <=> $x2->priorityby);
                    }

                }
            );
        } elseif (1==$item->manualOrderingOn) {
            $item->rawpercents = $item->rawpercents->sort(
                function (Rawpercent $x1, Rawpercent $x2) {


                    return ($x1->manualOrder <=> $x2->manualOrder);

                }
            );
        }


        $listArray = $item->rawpercents->collect('title');
        $listArray=array_unique($listArray);
        $listString = strtoupper(implode($listArray, ', '));

        return $listString;

    }


    public function UsInhalts2($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $line)
        {
            $ingroupId = $line->raw->ingroup->getPk();
            $line->title = $line->raw->ingroup->UsLister($ingroupId);

        };

        $item2 = $item->rawpercents->sort(
            function(Rawpercent $x1, Rawpercent $x2)
            {
                if (!((int)$x1->range->order == (int)$x2->range->order)) {
                    return ((int)$x1->range->order <=> (int)$x2->range->order);
                }
                return ($x1->raw->ingroup->priority <=> $x2->raw->ingroup->priority);
            }
        );

        $listArray = $item2->collect('title');
        $listString = strtoupper(implode($listArray, ', '));

        return $listString;

    }

    public function RuInhalts($id)
    {
        $item=Product::findByPK($id);

        foreach ($item->rawpercents as $line)
        {
            $ingroupId = $line->raw->ingroup->getPk();
            $line->title = $line->raw->ingroup->RuLister($ingroupId);

        };

        $item2 = $item->rawpercents->sort(
            function(Rawpercent $x1, Rawpercent $x2)
            {
                //if (((int)$x1->range->order !== (int)$x2->range->order)) {
                    return ((int)$x1->range->order <=> (int)$x2->range->order);
               // }
                //return ($x1->raw->ingroup->priority <=> $x2->raw->ingroup->priority);
            }
        );

        $listArray = $item2->collect('title');
        $listString =implode($listArray, ', ');

        return $listString;
    }

    /*public function DeclarationEu($id)
    {
        $item = Product::findById($id);

        $item->rawpercents;

            foreach ($item->rawpercents as $line)
            {
                $ingroupId = $line->raw->ingroup->getPk();
                $line->title = $line->raw->ingroup->EuLister($ingroupId);
                $line->interval = $line->StandartInterval($line->percent);
                $line->orderby = $line->interval['order'];

            }

            $item = $item->rawpercents->sort(
                function(Rawpercent $x1, Rawpercent $x2)
                {
                    return ((int)$x2->orderby <=> (int)$x1->orderby);
                }
            );


        return $item;

    }
*/

}