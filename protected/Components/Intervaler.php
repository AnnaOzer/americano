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
                $range = ['order'=> 1, 'interval' => '0% - 0,1%'];
                break;
            case $percent000 <= 1000:
                $range = ['order'=> 2, 'interval'  => '0,1% - 1%'];
                break;
            case $percent000 <= 5000:
                $range = ['order'=> 3, 'interval'  => '1% - 5%'];
                break;
            case $percent000 <= 10000:
                $range = ['order'=> 4, 'interval'  => '5% - 10%'];
                break;
            case $percent000 <= 25000:
                $range = ['order'=> 5, 'interval'  => '10% - 25%'];
                break;
            case $percent000 <= 50000:
                $range = ['order'=> 6, 'interval'  => '25% - 50%'];
                break;
            case $percent000 <= 75000:
                $range = ['order'=> 7, 'interval' => '50% - 75%'];
                break;
            case $percent000 <= 100000:
                $range = ['order'=> 8, 'interval'  => '75% - 100%'];
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