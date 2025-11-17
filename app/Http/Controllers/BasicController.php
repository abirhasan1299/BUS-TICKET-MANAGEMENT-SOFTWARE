<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Passenger;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasicController extends Controller
{
    public function Dashboard()
    {
        return view('basic.dashboard');
    }

    public function Home()
    {
        $data = BusRoute::whereHas('slot', function ($query) {
            $query->where('status','=',1);
        })
            ->orderBy('id', 'desc')
            ->select('start_location','id','end_location')
            ->distinct()
            ->get();

        return view('public.index', compact('data'));
    }

    public function Search(Request $request)
    {
        $data = Slot::orWhere('route_id',$request->start)
            ->where('status',1)
            ->orWhere('route_id',$request->end)
            ->orWhere('schedule',Carbon::parse($request->date)->format('d-m-Y'))
            ->get();
        return view('public.filter', compact('data'));
    }

    public function Seat($id)
    {
        $data = Slot::where('slot_code',hex2bin($id))->first();
        $booked = Cart::select('sit_list')
            ->where('slot_id',$data->id)
            ->where('status','paid')
            ->get();

        return view('public.seats', compact('data','booked'));
    }

    public function Cart(Request $request)
    {
       $validated = $request->validate([
           'gender'=>'required',
           'sit_count'=>'required|max:4',
           'sit_list'=>'required',
           'coupon'=>'nullable'
       ]);
       Cart::create([
           'user_id'=>Auth::id(),
           'slot_id'=>$request->slot_id,
           'sit_count'=>$request->sit_count,
           'sit_list'=>$request->sit_list,
           'gender'=>$request->gender,
           'coupon'=>$request->coupon,
       ]);

       return redirect()->route('users.cart')->with('success','Ticket Added to cart.');
    }

}
