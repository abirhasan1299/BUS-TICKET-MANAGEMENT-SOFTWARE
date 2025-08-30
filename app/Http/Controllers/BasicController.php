<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function index()
    {
        return view('public.index');
    }
    public function routes()
    {
        return view('public.route');
    }
    public function contact()
    {
        return view('public.contact');
    }
    public function Dashboard()
    {
        return view('basic.dashboard');
    }
}
