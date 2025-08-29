<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketManagingController extends Controller
{
    public function index()
    {
        return view('ticket-management.index');
    }
}
