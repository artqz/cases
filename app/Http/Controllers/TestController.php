<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tests;

class TestController extends Controller
{
    public function index ()
    {
        $tests = Tests::latest('created_at')->limit(100)->get();
        foreach ($tests as $test)
        {
            echo $test->case_price . '<br>';
        }
         echo '<a href="/test/create">test</a>';

    }

    public function store ()
    {
        //$tests = Tests::->latest('created_at')->limit(3)->get();
        //$testy['case_type'] =  1;
        //$testy['case_price'] =  2;
        $tests = Tests::latest('created_at')->limit(10)->get();

        $array = array();

        foreach ($tests as $test)
        {
            $array[] =  $test->case_price;
        }


        if (max($array) > 100)
        {
           $random_max = 100;
        }
        else $random_max = 200;

        Tests::create([
            'case_type' => 1,
            'case_price' => random_int(20,$random_max),
        ]);

        return redirect('/test');

    }
}
