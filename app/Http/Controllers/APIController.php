<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;

class APIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function calibrate(){
        $url = "http://34.70.96.106:8005/api/v1/calibrate/testing";
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
        $url = "http://34.70.96.106:8005/api/v1/by_location/testing";
        $request = Http::get($url)->json();
        $result = $request['locations'];
        $data = [];
        foreach($result as $items){
            $location =  $items['location'];
            foreach($items['devices'] as $a){
                $timestamp = $a['timestamp'];
                $data[] = [
                    'worker' => $a['device'],
                    'active_mins' => $a['active_mins'] ,
                    'timestamp' => Carbon::parse($timestamp)->diffForHumans(),
                    'location' => $location
                ];
            }
        }
        $worker = ['data' => $data];
        return $worker;
    }
    public function getCountWorkerByLocation(){
        $url = "http://34.70.96.106:8005/api/v1/by_location/testing";
        $request = Http::get($url)->json();
        $location = $request['locations'];
        $data = [];
        foreach($location as $items){
            $location =  $items['location'];
            $count = $items['total'];
                $data[] = [
                    'locations' => $location,
                    'total' => $count
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
