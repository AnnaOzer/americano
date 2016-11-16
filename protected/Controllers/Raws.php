<?php

namespace App\Controllers;

use App\Models\Ingroup;
use App\Models\Raw;
use T4\Mvc\Controller;

class Raws
    extends Controller
{

    public function actionDefault()
    {
        $item=Raw::findByPk(1);
        var_dump($item);
        var_dump($item->ingroup);
        die;


    }

}