<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function Dashboard()
    {
        return view('basic.dashboard');
    }
}
