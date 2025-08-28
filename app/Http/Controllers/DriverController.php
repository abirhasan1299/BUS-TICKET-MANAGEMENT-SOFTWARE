<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Mockery\Exception;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Driver::orderBy('id', 'DESC')->paginate(6);
        return view('driver.index',compact('data'));
    }

    /**
     * Display Filter of Driving through Field.
     */
    public function filter(Request $request)
    {
        $data = Driver::where('driver_code',$request->driver_code)
            ->orWhere('phone',$request->phone)
            ->orWhere('dob',$request->dob)
            ->orWhere('license_number',$request->license_number)
            ->get();
        return view('driver.filter',compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('driver.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'driver_code'=>'required|unique:drivers',
            'gov_id'=>'required|unique:drivers',
            'name'=>'required',
            'phone'=>'required|unique:drivers|min:11',
            'email'=>'nullable|max:255',
            'city'=>'required',
            'postal_code'=>'required',
            'license_number'=>'required',
            'license_expiry_date'=>'required|date',
            'address'=>'required',
            'dob'=>'required|date',
            'status'=>'required',
        ]);
        try{
            Driver::create($validated);
            return redirect()->route('driver.index')->with('success','Driver created successfully');

        }catch (\Exception $e){
            \Log::error($e->getMessage());
            return redirect()->route('driver.index')->with('danger','Something went wrong');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $driver = Driver::findOrFail($id);
        return view('driver.show',compact('driver'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Driver::findOrFail($id);
        return view('driver.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'driver_code'=>'required',
            'gov_id'=>'required',
            'name'=>'required',
            'phone'=>'required|min:11',
            'email'=>'nullable|max:255',
            'city'=>'required',
            'postal_code'=>'required',
            'license_number'=>'required',
            'license_expiry_date'=>'required|date',
            'address'=>'required',
            'dob'=>'required|date',
            'status'=>'required',
        ]);
         try{

             $data = Driver::findOrFail($id);
             $data->update($validated);
             return redirect()->route('driver.index')->with('success','Updated Successfully');

         }catch (\Exception $e)
         {
             return redirect()->route('driver.index')->with('danger','Something Went Wrong');
         }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Driver::findOrFail($id);
        $data->delete();
        return redirect()->route('driver.index')->with('success','Driver deleted successfully');
    }
}
