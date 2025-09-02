<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BasicController extends Controller
{
    public function Dashboard()
    {
        return view('basic.dashboard');
    }

    public function Home()
    {
        $data = Slot::orderBy('id', 'desc')->get();
        return view('public.index', compact('data'));
    }

    public function Search(Request $request)
    {
        $data = Slot::orWhere('id',$request->start)
            ->where('status',1)
            ->orWhere('id',$request->end)
            ->orWhere('schedule',Carbon::parse($request->date)->format('d-m-Y'))
            ->get();
        return view('public.filter', compact('data'));
    }

    public function Seat($id)
    {
        $data = Slot::where('slot_code',hex2bin($id))->first();
        //dd($data);
        return view('public.seats', compact('data'));
    }
}
