<?php

namespace App\Controllers;

use App\Models\Product;
use T4\Mvc\Controller;

class Test
    extends Controller
{

    public function actionDefault()
    {
        $items = Product::findAll();
        $items->sort(function($x1, $x2){ return $x1->labName <=> $x2->labName; });
        var_dump($items); die;
    }

    public function actionFoo()
    {
        $items = Product::findAll();
        $list = $items->collect('labName');
        $text = implode($list, ', ');
        var_dump($items);
        echo "<br>";
        var_dump($list);
        echo "<br>";
        var_dump($text);
        die;
    }

}