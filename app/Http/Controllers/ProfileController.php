<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;

class ProfileController extends Controller
{

    public function Invoice($encryptId)
    {
        try{
            $data = Payment::where('id', Crypt::decrypt($encryptId))->first();
            $cart = Cart::where('id',$data->cart_id)->first();
            return view('ticket.invoice',compact('data','cart'));
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('users.cart')->with('error','Something went wrong');
        }

    }
    public function TicketInfo ($string)
    {
        try{
            $decryptId = Crypt::decrypt($string);
            $data = Cart::findOrFail($decryptId);

            $payment = Payment::where('cart_id',$decryptId)->first();
            return view('ticket.template', compact('data','payment'));

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return abort(404);
        }

    }

    public function PaymentInfo()
    {
        $data  = Payment::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->paginate(5);
        $cart_count = Cart::where('user_id',Auth::user()->id)->count();
        return view('user.payment',compact('data','cart_count'));
    }

    public function Cart()
    {
        $data = Cart::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->paginate(5);
        $cart_count = count($data);
        return view('user.cart',compact('data','cart_count'));
    }

    public function CartTrash($id)
    {
        try{
            $model = Cart::findOrFail($id);
            $model->delete();
            return redirect()->route('users.cart');

        }catch(\Exception $e){
            Log::error($e->getMessage());
            return  redirect()->route('users.cart')->with('error','Something went wrong');
        }

    }
}
