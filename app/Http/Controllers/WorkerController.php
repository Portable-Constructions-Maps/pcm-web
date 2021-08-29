<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Worker;

class WorkerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function getWorker(){
        // $url = getBaseUrl() . "api/v1/by_location/". getOrg();
        // $request = Http::get($url)->json();
        // $result = $request['locations'];
        
        // foreach($result as $items){
        //     $location =  $items['location'];
        //     foreach($items['devices'] as $a){
        //         $timestamp = $a['timestamp'];
        //         $data = [
        //             'worker' => $a['device'],
        //             'active_mins' => $a['active_mins'] ,
        //             'probability' => $a['probability'] * 100 . '%',
        //             'timestamp' => Carbon::parse($timestamp)->diffForHumans(),
        //             'location' => $location
        //         ];
        //     }
        // }
        // $worker = ['data' => $data];
        return workers_by_location(getOrg());
    }
    public function triggerWorker(Request $request){
        $status = $request->status == 1 ? true : false;
        $uuid =  $request->uuid;
        $org  = getOrg();
        $device =  Worker::where('uuid', $uuid)->first();
        $device->is_trigger = $status;
        $device->save();
        if($device){
            publishMqtt($org,$uuid, $status);
            return redirect()->back()->with('success','Berhasil');
        }else {
            return redirect()->back()->with('error','Gagal');
        }
        // return $data = [
        //     'uuid' => $uuid,
        //     'org' => $org,
        //     'status' => $status,
        // ]; //

    }
    public function index()
    {
        //dd(createOrg(getOrg()));
        //return dd(getDevices());
        $data   = getDevices();
        if($data!=null){
            $result=  setResponse($data,true,"berhasil");
            //return dd($result['data']);
            return view('worker.index')->with('workers', $result);
          }else {
            $result=  setResponse($data,false,"gagal");
            //return dd($result['status']);
            return view('worker.index')->with('workers', $result);
          }
        
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
        $uuid  =$request->uuid;
        $getOrg =  explode('-', $request->uuid);
        $org = getOrg();
        $status = $getOrg[0]==$org? true :false;
        $data = [
            'name' => $name,
            'organization' => getOrg(),
            'device_id' => $uuid,
            'status' => $status
        ];
        if($status){
            $worker = Worker::create([
                'name' => $name,
                'uuid' => $uuid,
                'org' => getOrg(),
            ]);
            if($worker){
                createDevice($uuid, getOrg());
                return redirect()->back()->with('message','Berhasil menambahkan device');
            }
        }return redirect()->back()->with('message','Device tidak terdaftar di organisasi ini');
        
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
    public function mqtt($org,$device,$status){
        
        return publishMqtt($org, $device, $status);
    }
    public function mqttTest(){
        return publishMqttTest();
    }
}
