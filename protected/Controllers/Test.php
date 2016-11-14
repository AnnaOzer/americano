<?php

namespace App\Controllers;

use T4\Mvc\Controller;

class Test
    extends Controller
{

    public function actionDefault()
    {
        var_dump($this->app->db->default); die;
    }

}