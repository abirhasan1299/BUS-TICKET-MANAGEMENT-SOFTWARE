<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Coupon::orderBy('id', 'DESC')->paginate(10);
        return view('coupon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coupon.create');

    }
        //FILTER THE DATA
     public function filter(Request $request)
     {
         $model = Coupon::where('name',$request->name)
             ->orWhere('coupon_code',$request->coupon_code)
             ->orWhere('expire',$request->date)
             ->get();
         return view('coupon.filter', compact('model'));
     }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'name' => 'required|max:255',
           'coupon_code' => 'required|max:255',
           'expire'=>'required|date',
           'status'=>'required',
            'discount'=>'required|numeric|max:100'
        ]);

        try{

            Coupon::create($validatedData);
            return redirect()->route('coupon.index')->with('success','Coupon Added Successfully');
        }catch (\Exception $e)
        {
            return redirect()->route('coupon.index')->with('danger','Something Went Wrong');
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
        try{
            $model = Coupon::findOrFail($id);
            $model->delete();
            return redirect()->route('coupon.index')->with('success','Coupon Deleted Successfully');
        }catch (\Exception $e)
        {
            return redirect()->route('coupon.index')->with('danger','Something Went Wrong');
        }
    }
}
