<?php
/**
 * Created by PhpStorm.
 * User: Пользователь
 * Date: 18.11.2016
 * Time: 10:56
 */

namespace App\Components;
/*
получает int значение в тысячах процентов
возвращает массив вроде[ 3 =>'1-5']
*/

class Intervaler
{
    public $percentage;

    public function StandartIntervaler($percent000)
    {
        $range = [];

        switch (true) {
            case $percent000 <= 100:
                $range = ['order'=> 1, 'interval' => '&le; 0,1%'];
                break;
            case $percent000 <= 1000:
                $range = ['order'=> 2, 'interval'  => '> 0,1% to &le; 1%'];
                break;
            case $percent000 <= 5000:
                $range = ['order'=> 3, 'interval'  => '> 1% to &le; 5%'];
                break;
            case $percent000 <= 10000:
                $range = ['order'=> 4, 'interval'  => '> 5% to &le; 10%'];
                break;
            case $percent000 <= 25000:
                $range = ['order'=> 5, 'interval'  => '> 10% to &le; 25%'];
                break;
            case $percent000 <= 50000:
                $range = ['order'=> 6, 'interval'  => '> 25% to &le; 50%'];
                break;
            case $percent000 <= 75000:
                $range = ['order'=> 7, 'interval' => '> 50% to &le; 75%'];
                break;
            case $percent000 <= 100000:
                $range = ['order'=> 8, 'interval'  => '> 75% to 100%'];
                break;
        }

        return $range;
    }


    public function ExactIntervaler($percent000)
    {
        $range = [];

        $exactInterval = $percent000 / 1000 . '%';

        switch (true) {
            case $percent000 <= 100:
                $range = ['order' => 1, 'interval' => $exactInterval];
                break;
            case $percent000 <= 1000:
                $range = ['order' => 2, 'interval' => $exactInterval];
                break;
            case $percent000 <= 5000:
                $range = ['order' => 3, 'interval' => $exactInterval];
                break;
            case $percent000 <= 10000:
                $range = ['order' => 4, 'interval' => $exactInterval];
                break;
            case $percent000 <= 25000:
                $range = ['order' => 5, 'interval' => $exactInterval];
                break;
            case $percent000 <= 50000:
                $range = ['order' => 6, 'interval' => $exactInterval];
                break;
            case $percent000 <= 75000:
                $range = ['order' => 7, 'interval' => $exactInterval];
                break;
            case $percent000 <= 100000:
                $range = ['order' => 8, 'interval' => $exactInterval];
                break;
        }

        return $range;
    }

/*
        public function __construct($percentage)
        {
            $this->percentage = $percentage;
        }
    
    */
}