<?php

namespace App\Controllers;

use App\Models\Seria;
use T4\Mvc\Controller;

class Tedmire
    extends Controller
{

    public function actionDefault()
    {

        $item = Seria::findByTitle('tedmire');
        $item->products;
        $this->data->item = $item;
    }


    
}

