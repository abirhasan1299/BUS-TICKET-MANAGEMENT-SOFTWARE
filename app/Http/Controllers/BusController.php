<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class BusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $buses = Bus::orderBy('id', 'desc')->paginate(6);
        return view('bus.index', compact('buses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $busCode = "BUS" . random_int(100000, 999999);
        return view('bus.create', compact('busCode'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bus_code'            => 'required|string|max:50|unique:buses,bus_code',
            'registration_number' => 'required|string|max:50|unique:buses,registration_number',
            'bus_name'            => 'required|string|max:100',
            'bus_owner_info'      => 'required|string|max:150',
            'type'                => 'required|in:AC,Non-AC,Sleeper',
            'seat_capacity'       => 'required|integer|min:1',
            'available_seats'     => 'nullable|integer|min:0|max:'.$request->seat_capacity,

            'wifi'           => 'required|boolean',
            'tv'             => 'required|boolean',
            'ac'             => 'required|boolean',
            'charging_port'  => 'required|boolean',
            'washroom'       => 'required|boolean',

            'status'             => 'required',
            'fitness_expiry'     => 'nullable|date',
            'additional_info'    => 'nullable|string|max:255',
            'total_rows'=>'required',
            'seat_per_row' =>'required'
        ]);
        try{

            Bus::create($validated);
            return redirect()->route('bus.index')->with('success', 'Bus has been created successfully');
        }catch (\Exception $e){
            return redirect()->route('bus.index')->with('error', "Something went wrong");
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bus= Bus::findOrFail($id);
        return view('bus.show', compact('bus'));
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
        $data = Bus::findOrFail($id);
        $data->delete();
        return redirect()->route('bus.index')->with('success', 'Bus has been deleted successfully');
    }
}
