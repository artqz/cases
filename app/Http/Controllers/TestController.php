<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tests;

class TestController extends Controller
{
    public function index ()
    {
        $tests = Tests::all();
        foreach ($tests as $test)
        {
            echo $test->case_price . '<br>';
        }
         echo '<a href="/test/create">test</a>';

    }

    public function store ()
    {

        //$testy['case_type'] =  1;
        //$testy['case_price'] =  2;
        Tests::create([
            'case_type' => 1,
            'case_price' => random_int(20,200),
        ]);
        return redirect('/test');
    }
}
