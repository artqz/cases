<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
//создаем сколько угодно диапазонов, со счетчиком, частотой появления и верхней границей в отношении к верхнему пределу общего рандома
    $counts = array (
        //например, до 9% от максимум 1 раз из 100
        '0' => array ('count' => 1, 'ratio' => 0.01, 'amount' => 0.09),
        //до 50% - 20 из 100
        '1' => array ('count' => 1, 'ratio' => 0.20, 'amount' => 0.50),
        '2' => array ('count' => 1, 'ratio' => 0.50, 'amount' => 0.75),
        //count - счетчик срабатываний
        '3' => array ('count' => 1, 'ratio' => 0.29, 'amount' => 1),
        //total - общий счетчик
        'total' => 1
    );

//функция проверки на превышение частоты появления
    function check($count_to_check) {
        global $counts;
        if ($counts[$count_to_check]['count']/$counts['total'] < $counts[$count_to_check]['ratio']) {
            return true;
        }
        else {
            return false;
        }
    }

//функция корректировки счетчиков
    function plus($count_to_plus) {
        global $counts;
        $counts[$count_to_plus]['count']++;
        $counts['total']++;
    }

//сам генератор теперь такой
    function gen_price($min,$max) {
        global $counts;
//выбрали диапазон
        $gen_d = round(rand(0,count($counts)-2),-0.5);
//проверили соответствие нужной частоте появления
        if (check($gen_d)) {
            plus($gen_d);
//если первый даипазон, генерим от минимума до его предела
            if ($gen_d==0) return round(rand($min,$counts[$gen_d]['amount']*$max),-0.5);
//иначе от предела предыдущего диапазона до своего предела
            return round(rand($counts[$gen_d-1]['amount']*$max,$counts[$gen_d]['amount']*$max),-0.5);
        }
    }

//проверяем
    $min = 1; $max = 100;
    for ($tries = 0; $tries < 100; $tries++) {
        $price_gen = 0;
        //без while иногда пропуски были, более быстрого решения не придумал
        while (!$price_gen) $price_gen = gen_price($min,$max);
        echo $price_gen . " ";
    }
});
