<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Models\Cart;
use App\Models\Driver;
use App\Models\User;
use App\Models\Coupon;
use App\Models\Passenger;
use App\Models\Payment;
use App\Models\Slot;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BasicController extends Controller
{
    public function Dashboard()
    {
        $user = User::count();
        $amount = Payment::where('status','paid')->sum('amount');
        $busroute = BusRoute::count();
        $drivers = Driver::count();
        return view('basic.dashboard',compact('user','amount','busroute','drivers'));
    }
    public function AdminLogout()
    {
        session()->flush();
        return redirect()->route('admin.login');
    }
    public function adminLogin()
    {
        return view('admins.login');
    }

    public function adminCheck(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required|min:6'
        ]);

        if($request->username==config('app.admin_username') && $request->password==config('app.admin_password'))
        {
            session([
                'admin_username' => $request->username,
                'admin_password' => $request->password
            ]);
            return redirect()->route('basic.dashboard');
        }else{
            return redirect()->route('admin.login')->with('error','Invalid username or password');
        }
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

        //for disable the layout of already booked seat
        $booked = Cart::select('sit_list')
            ->where('slot_id',$data->id)
            ->where('status','purchased')
            ->get();

        return view('public.seats', compact('data','booked'));
    }

    public function Cart(Request $request)
    {
       $validated = $request->validate([
           'gender'=>'required',
           'sit_count'=>'required',
           'sit_list'=>'required',
           'coupon'=>'nullable'
       ]);


       if(session('is_premium'))
       {
           if($request->sit_count>6){
               return redirect()->back()->with('error', 'You can take max six sit at a time');
           }
       }else{
           if($request->sit_count>4){
               return redirect()->back()->with('error', 'You can take max four sit at a time');
           }
       }

       //coupon code checking is it exist and or is expired ??
       if(!empty($request->coupon)){
           $coupon = Coupon::where('coupon_code',$request->coupon)->first();

           //check has there any data in $coupon??
           if($coupon !=null){

               //chekcking has this coupon is exipired or not ??
               if(Carbon::parse($coupon->expire)->isPast()){
                   return redirect()->back()->with('error', 'Expired coupon code');
               }else{
                   //count increase that how many times it coupon used ??
                   Coupon::where('coupon_code',$request->coupon)->increment('count');
               }
           }else{
               return redirect()->back()->with('error', 'Invalid coupon code');
           }
       }

        Cart::create([
            'user_id'=>Auth::id(),
            'slot_id'=>$request->slot_id,
            'sit_count'=>$request->sit_count,
            'sit_list'=>$request->sit_list,
            'gender'=>$request->gender,
            'coupon'=>$coupon->id??null,
        ]);

        return redirect()->route('users.cart')->with('success','Ticket Added to cart.');


    }

}
