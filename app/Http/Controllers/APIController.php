<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Room;


class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function displayMonitor(){
        $data =  mergeData(by_location(getOrg()));
        return [
            "data" =>  $data,
        ];
    }
    public function calibrate(){
        $url = getBaseUrl(). "api/v1/calibrate/". getOrg();
        $result = Http::get($url)->json();
        $data  = [
            'data' => $result
        ];
        if($result['success']){
            return redirect()->back()->with('success', 'Berhasil Kalibrasi');
        }else {
            return redirect()->back()->with('error', 'Gagal Kalibrasi');
        }

    }
    public function getWokrersByLocation() {
        $data =  mergeData(by_location(getOrg()));
        $byarea = workersByLocation($data,'location');
        $workergroup = workerGroupByArea($data);
        return $workergroup;
        return $result = [
            "data" => $workergroup
        ];
    }
    public function getCountWorkerByLocation(){
        $url = getBaseUrl()."api/v1/by_location/". getOrg();
        $request = Http::get($url)->json();
        $location = $request['locations'];
        $dangerRooms = Room::all();

        $data = [];
        foreach($location as $items){
            $isDanger = false;
            foreach($dangerRooms as $dr){
                if($items['location'] == $dr->name && $dr->is_danger == 1){
                    $isDanger = true;
                }
            }
            $location =  $items['location'];
            $count = $items['total'];
                $data[] = [
                    'locations' => $location,
                    'total' => $count,
                    'is_danger' => $isDanger
                ];
        }
        $result  = [
            'data' => $data
        ];
        return $data;
    }
    public function index()
    {
        //
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
        //
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
