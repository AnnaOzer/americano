<?php

namespace App\Controllers;

use App\Models\Product;
use App\Models\Seria;
use T4\Mvc\Controller;

class Passports
    extends Controller
{

    public function actionDefault()
    {
        $this->app->assets->publishCssFile('/Layouts/assets/article.css');
        $items = Seria::findAll();

    }

    public function actionEng()
    {
        $this->app->assets->publishCssFile('/Layouts/assets/article.css');
        $items = Seria::findAll();
        foreach ($items as $item) {
            $item->products;
        }
        foreach ($items as $item){
            $item->products=$item->products->sort(
                function (Product $x1, Product $x2) {
                    return $x1->ordering <=> $x2->ordering;
                }
            );
        }
        $this->data->items = $items;

    }

    public function actionEngSelected()
    {
        $this->app->assets->publishCssFile('/Layouts/assets/bantik.css');
        $this->app->assets->publishCssFile('/Layouts/assets/article.css');
        $items = Seria::findAll();

    }

    public function actionRus()
    {
        $this->app->assets->publishCssFile('/Layouts/assets/article.css');
        $items = Seria::findAll();
        foreach ($items as $item) {
            $item->products;
        }
        foreach ($items as $item){
            $item->products=$item->products->sort(
                function (Product $x1, Product $x2) {
                    return $x1->ordering <=> $x2->ordering;
                }
            );
        }
        $this->data->items = $items;

    }

    public function actionRusTable()
    {
        $this->app->assets->publishCssFile('/Layouts/assets/table.css');

        $products = Product::findAll();
        
        
            $products=$products->sort(
                function (Product $x1, Product $x2) {
                    return $x1->orderingTable <=> $x2->orderingTable;
                }
            );
  
        $this->data->products = $products;

    }

    public function actionEngTable()
    {
        $this->app->assets->publishCssFile('/Layouts/assets/table.css');

        $products = Product::findAll();

        $products=$products->sort(
            function (Product $x1, Product $x2) {
                return $x1->orderingTable <=> $x2->orderingTable;
            }
        );

        $products=$products->filter(
            function (Product $x) {
                return $x->seria->title <=> 'tedmire';
            }
        );

 

        $this->data->products = $products;

    }

    public function actionRusSelected()
    {
        $this->app->assets->publishCssFile('/Layouts/assets/bantik.css');
        $this->app->assets->publishCssFile('/Layouts/assets/article.css');
        $items = Seria::findAll();

    }
    
}