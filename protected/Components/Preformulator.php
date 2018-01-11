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


class Preformulator
{
    public static function EuPreformulator($id)
    {
        return $item = Megaproduct::Builder($id);

    }
}
    