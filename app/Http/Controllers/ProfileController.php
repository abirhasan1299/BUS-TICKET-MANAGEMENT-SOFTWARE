<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

    public function Cart()
    {
        $data = Cart::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        $cart_count = count($data);
        return view('user.cart',compact('data','cart_count'));
    }

    public function CartTrash($id)
    {
        $model = Cart::findOrFail($id);
        $model->delete();
        return redirect()->route('users.cart');
    }
}
