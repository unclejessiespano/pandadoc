<?php

namespace Bigandbrown\Pandadoc;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PandadocController extends Controller
{
    public function add($a, $b){
        $result = $a + $b;
        return view('pandadoc::add', compact('result'));
    }

    public function subtract($a, $b){
        echo $a - $b;
    }
}
