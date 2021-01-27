<?php

namespace App\Controllers;

use App\Components\Preformulator;
use T4\Mvc\Controller;

class Index
    extends Controller
{

    public function actionDefault()
    {

    }

    public function actionTest($id=57)
    {
        $item = Preformulator::EuPreformulator($id);
        var_dump($item); die;
    }
}