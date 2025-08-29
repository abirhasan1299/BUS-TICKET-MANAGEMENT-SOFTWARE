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
        $data = Slot::orderBy('id', 'desc')->paginate(10);
        return view('slot.index', compact('data'));
    }

    //Filter the slot
    public function filter(Request $request)
    {

        $data = Slot::where('slot_code',substr($request->slot_code,5))
            ->orWhere('price',$request->price)
            ->get();
        return view('slot.filter', compact('data'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $bus = Bus::all();
        $driver = Driver::all();
        $route = BusRoute::all();
        $model= Slot::orderBy('id', 'desc')->first();
        if($model)
        {
            $slot_code = $model->slot_code + 1;
        }else{
            $slot_code = date('Y');
        }
        return view('slot.create',compact('bus','driver','route','slot_code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'slot_code'=>'required',
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
        $data = Slot::findOrFail($id);
        return view('slot.show',compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Slot::findOrFail($id);
        $bus = Bus::all();
        $driver = Driver::all();
        $route = BusRoute::all();
        return view('slot.edit',compact('data','bus','driver','route'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
       try{
           $validate = $request->validate([
               'route_id' => 'required|exists:routes,id',
               'bus_id' => 'required|exists:buses,id',
               'driver_id' => 'required|exists:drivers,id',
               'schedule' => 'required',
               'price' => 'required|numeric',
               'discount' => 'required|numeric',
               'status' => 'required'
           ]);
           $model = Slot::findOrFail($id);
           $model->update($validate);
           return redirect()->route('slot.index')->with('success','Slot updated successfully');
       }catch(\Exception $e)
       {
           return redirect()->route('slot.index')->with('danger','Somthing went wrong');
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Slot::findOrFail($id);
        try{

            $data->delete();
            return redirect()->route('slot.index')->with('success','Slot deleted successfully');

        }catch (\Exception $e)
        {
            return redirect()->route('slot.index')->with('danger','Error , something went wrong');
        }
    }
}
