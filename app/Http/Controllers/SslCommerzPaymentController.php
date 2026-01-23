<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use App\Models\Cart;
use App\Models\Payment;
use App\Models\Slot;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SslCommerzPaymentController extends Controller
{


    public function index(Request $request)
    {
        try{
            if(session('is_premium')){
                $amount = $request->amount-config('app.discount_amount');
                $membership = 1;
            }else{
                $amount = $request->amount;
                $membership = 0;
            }
            session([
                'cart_id'=>$request->cart_id,
                'amount'=>$amount,
                'slot_id'=>$request->slot_id,
                'trans_id'=>bin2hex(random_bytes(8)),
                'otp'=>random_int(100000,999999),
                'membership'=>$membership,
            ]);

            Mail::to(Auth::user()->email)->queue(new OtpMail(session('otp')));

            return view('ticket.checkout');
        }catch (\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('users.cart')->with('error','Something went wrong... Try Again');
        }

    }

    public function success(Request $request)
    {
        try{
            if($request->otp==session('otp'))
            {
                  //[NEED TO CHECK IF ANY USER ALREADY BUY THIS SIT OR NOT?
                  //Need to implement this function]

                Payment::create([
                    'transaction_id'=>session('trans_id'),
                    'user_id'=>Auth::id(),
                    'slot_id'=>session('slot_id'),
                    'cart_id'=>session('cart_id'),
                    'amount'=>session('amount'),
                    'currency'=>"BDT",
                    'created_at'=>now(),
                    'updated_at'=>now(),
                    'status'=>"paid",
                    'membership'=>session('membership'),
                ]);
                Cart::where('id',session('cart_id'))->where('user_id',Auth::id())->update(['status'=>'purchased']);
                DB::commit();
                session()->flush();
                return view('public.success');
            }else{
                return redirect()->route('users.cart')->with('error','Invalid OTP... Try Again');
            }

        }catch(\Exception $e){
            DB::rollback();
            \Log::error('Payment success handling error: '.$e->getMessage());
            return abort(505);
        }

    }


}
