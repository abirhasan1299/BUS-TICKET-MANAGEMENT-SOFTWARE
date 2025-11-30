<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Payment;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class ProfileController extends Controller
{
    public function TicketInfo ($string)
    {
        try{
            $decryptId = Crypt::decrypt($string);
            $data = Cart::findOrFail($decryptId);

            $payment = Payment::where('cart_id',$decryptId)->first();
            return view('ticket.template', compact('data','payment'));

        }catch(\Exception $e){
            return abort(404);
        }

    }

    public function PaymentInfo()
    {
        $data  = Payment::where('user_id',Auth::user()->id)->orderBy('id', 'DESC')->get();

        return view('user.payment',compact('data'));
    }

    public function Cart()
    {
        $data = Cart::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
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
            return abort(404);
        }

    }
}
