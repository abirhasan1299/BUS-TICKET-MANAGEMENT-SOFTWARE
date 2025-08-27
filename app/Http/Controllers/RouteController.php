<?php

namespace App\Http\Controllers;

use App\Models\BusRoute;
use App\Models\Route;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = BusRoute::orderBy('id', 'desc')->get();
        return view('route.index',compact('data'));
    }

    /**
     * Filter the data to send filter page.
     */
    public function filter(Request $request)
    {
        $data = BusRoute::where('route_code',$request->route_code)
            ->orWhere('start_location',$request->start_location)
            ->orWhere('end_location',$request->end_location)
            ->orWhere('distance',$request->distance)
            ->get();

        return view('route.filter',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function generateUnique($length = 8) {
        return substr(strtoupper(base_convert(uniqid(mt_rand(), true), 10, 36)), 0, $length);
    }
    public function create()
    {
        $code = $this->generateUnique(6);
        return view('route.create',compact('code'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
           'route_code'=>'required|unique:routes,route_code',
           'start_location'=>'required|max:255',
           'end_location'=>'required|max:255',
           'distance'=>'required|max:255',
           'estemated_time'=>'required|max:255',
           'status'=>'required'
        ]);

        BusRoute::create($validatedData);
        return redirect()->route('route.index')->with('success','Route created successfully');
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
        $data = BusRoute::findOrFail($id);
        return view('route.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validate = $request->validate([
            'start_location'=>'required|max:255',
            'end_location'=>'required|max:255',
            'distance'=>'required|max:255',
            'estemated_time'=>'required|max:255',
            'status'=>'required'
        ]);
        $model = BusRoute::findOrFail($id);
        $model->update($validate);
        return redirect()->route('route.index')->with('success','Updated Data Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = BusRoute::findOrFail($id);
        $data->delete();
        return redirect()->route('route.index');
    }
}
