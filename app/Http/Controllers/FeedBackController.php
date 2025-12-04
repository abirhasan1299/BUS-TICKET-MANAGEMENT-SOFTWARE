<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Comment;
use App\Models\Feedback;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FeedBackController extends Controller
{
    public function index($encryptId)
    {
        $decryptId = Crypt::decrypt($encryptId);
        $Cartdata = Cart::where('id',$decryptId)->first();
        $PaymentData = Payment::where('cart_id',$Cartdata->id)->first();
        return view('user.feedback',compact('Cartdata','PaymentData'));
    }

    public function store(Request $request)
    {
        try{
            $unique_code = strtolower(uniqid());

            Feedback::create([
                'slot_id' => $request->slot_id,
                'cart_id' => $request->cart_id,
                'user_id' => Auth::id(),
                'unique_code' => $unique_code,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            Comment::create([
               'feedback_code'=>$unique_code,
               'overall_rating'=>$request->overall_rating,
               'cleanliness_rating'=>$request->cleanliness_rating,
               'driver_rating'=>$request->driver_rating,
               'comfort_rating' =>$request->comfort_rating,
                'punctuality_rating'=>$request->punctuality_rating,
                'comments'=>$request->comments,
                'recommendation'=>$request->recommendation,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            DB::commit();
            return redirect()->route('users.cart')->with('success','Thanks for your feedback');
        }catch(\Exception $e){
            DB::rollBack();
            Log::error($e->getMessage());
            return redirect()->route('users.cart')->with('error','Something went wrong');
        }

    }

}
