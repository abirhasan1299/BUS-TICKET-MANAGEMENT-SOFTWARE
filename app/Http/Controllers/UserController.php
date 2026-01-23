<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\Mail\WelcomeMail;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function ForgetPassword()
    {
        return view('user.forget');
    }

    public function ResetPassword(Request $request)
    {
        if(session('password_reset_otp')==$request->otp){
            User::where('id',session('user_id'))->update(['password'=>Hash::make($request->password)]);
            session()->flush();
            return redirect()->route('users.index')->with('success',"Password reset successfully");
        }else{
            return redirect()->route('users.index')->with('error',"Invalid OTP");
        }
    }
    public function ForgetPasswordPost(Request $request)
    {
        $request->validate([
            'email'=>'email|required'
        ]);
        try{
            $data = User::where('email',$request->email)->first();
            if($data != null)
            {
                $reset_pass_otp = random_int(100000,999999);
                session([
                    'password_reset_otp' => $reset_pass_otp,
                    'user_id' => $data->id
                ]);
                Mail::to($data->email)->queue(new ResetPasswordMail($reset_pass_otp));
                return view('user.reset_pass_otp');

            }else{
                return redirect()->route('forget.password')->with('error','No Email Exist... Try Again');
            }
        }catch(\Exception $e){
            Log::error($e->getMessage());
            return redirect()->route('forget.password')->with('error','Something went wrong');
        }
    }
    //Login Action
    public function Login(Request $request)
    {
        $validate = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if(Payment::where('user_id',Auth::id())->where('status','paid')->sum('amount')>=config('app.premium_amount'))
            {
                session([
                    'is_premium' => true
                ]);

            }else{
                session([
                    'is_premium' => false
                ]);
            }
            return redirect()->route('users.cart');
        }
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.'
        ])->withInput();
    }
    //user logout
    public function Logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('users.index');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('user.login');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.registration');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validatedData = $request->validate([
           'name' => 'required|max:255',
           'email' => 'required|unique:users,email',
           'password' => 'required|min:6|confirmed',
           'phone' => 'required|max:13|min:11|unique:users,phone'
        ]);
        try{

            $user = new User();
            $user->name= $validatedData['name'];
            $user->email = $validatedData['email'];
            $user->phone = $validatedData['phone'];
            $user->password = Hash::make($validatedData['password']);
            $user->save();

            Mail::to($validatedData['email'])->queue(new WelcomeMail($validatedData['name']));

            return redirect()->route('users.index')->with('success', 'User Created Successfully');

        }catch (\Exception $e){
           Log::error($e->getMessage());
           return redirect()->route('users.index')->with('error', 'User Created Failed... Try Again ');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
