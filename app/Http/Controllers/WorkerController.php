<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Carbon\Carbon;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getWorker(){
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
    public function index()
    {
    
        return view('worker.index');
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
