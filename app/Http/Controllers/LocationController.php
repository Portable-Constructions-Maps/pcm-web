<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $locations = Location::where('org',getOrg())->get();
        //return $locations;

        return view('locations.index')->with('locations', $locations);
    }
     
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->name;
        $org  = getOrg();

        $location = Location::create([
            'name' => $name,
            'is_danger' => 0,
            'org' => $org
        ]);
        if($location){
            createArea($name, $org);
            //return dd('success');
            return redirect()->back()->with('success','berhasil');
        }else{
            //return dd('failed');
            return redirect()->back()->with('error','error');
        }
        
    }
    public function setStatus(Request $request) {
        $id = $request->id;
        $status = $request->status;
        $locations = Location::find($id);
        $locations->is_danger = $status;
        $locations->save();
        if($locations){
            return redirect()->back()->with('success','oke');
        }
        return redirect()->back()->with('error','gagal!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
