<?php

namespace App\Controllers;

use App\Components\Intervaler;
use App\Models\Product;
use App\Models\Test;
use T4\Http\Uploader;
use T4\Fs\Helpers;
use T4\Mvc\Controller;

class Tests
    extends Controller
{

    public function actionDefault()
    {
        $this->data->items = Test::findAll();
        /*
        $t = 35;
        var_dump((new Intervaler($t))->StandartIntervaler($this->percentage));
        die;
        */
    }
    
    public function actionAddFile(Test $test) {

        $request = $this->app->request;


        
        if ($test) {

            $uploader = (new Uploader('test[image]'))->setPath(ROOT_PATH_PUBLIC . '/syrie');



            var_dump($uploader->isUploaded()); die;

            $test->save();
        }

        
        $this->redirect('/Tests');
    }

    public function actionBar()
    {
        $items = Product::findAll();
        $items->sort(function($x1, $x2){ return strcmp($x1->labName,  $x2->labName); });
        var_dump($items); die;
    }

    public function actionFoo()
    {
        $items = Product::findAll();
        $items2 = $items->sort(function($x1, $x2){ return $x1->labName <=> $x2->labName; });
        $list = $items2->collect('labName');
        $text = implode($list, ', ');
        var_dump($text);
        die;
    }


    private function array_sort($array, $on, $order=SORT_ASC)
    {
        $new_array = array();
        $sortable_array = array();

        if (count($array) > 0) {
            foreach ($array as $k => $v) {
                if (is_array($v)) {
                    foreach ($v as $k2 => $v2) {
                        if ($k2 == $on) {
                            $sortable_array[$k] = $v2;
                        }
                    }
                } else {
                    $sortable_array[$k] = $v;
                }
            }

            switch ($order) {
                case SORT_ASC:
                    asort($sortable_array);
                    break;
                case SORT_DESC:
                    arsort($sortable_array);
                    break;
            }

            foreach ($sortable_array as $k => $v) {
                $new_array[$k] = $array[$k];
            }
        }

        return $new_array;
    }

}

