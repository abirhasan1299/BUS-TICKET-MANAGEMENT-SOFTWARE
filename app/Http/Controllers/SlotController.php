<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use App\Models\BusRoute;
use App\Models\Driver;
use App\Models\Slot;
use Illuminate\Http\Request;

class SlotController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Slot::orderBy('id', 'desc')->get();
        return view('slot.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bus = Bus::all();
        $driver = Driver::all();
        $route = BusRoute::all();
        return view('slot.create',compact('bus','driver','route'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'route_id' => 'required|exists:routes,id',
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:drivers,id',
            'schedule' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'status' => 'required'
        ]);
        try{
            Slot::create($validated);
            return redirect()->route('slot.index')->with('success','Slot added successfully');
        }catch (\Exception $e){
            return redirect()->route('slot.index')->with('danger','Somthing went wrong');
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
