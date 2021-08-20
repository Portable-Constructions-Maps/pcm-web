<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Carbon\Carbon;
use App\Room;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->org == null){
            return view('setup.index');
        }else {
            return view('home');
        }
      
    }
    public function worker(){
        return view('worker.add');
    }
    public function room(){
        $url = getBaseUrl()."api/v1/efficacy/". getOrg();
        $request = Http::get($url)->json();
        //dd($request);
        if($request['success'] == true){
            $status = true;
            dd($request);
            $result = $request['efficacy'];
            $rooms = $result['accuracy_breakdown'];
            $timestamp = $result['last_calibration_time'];
            $lastCalibrate =  Carbon::createFromTimestamp($timestamp)->diffForHumans();

            $dangerRooms = Room::all();
            foreach($rooms as $room => $key){
                $isDanger = false;
                foreach($dangerRooms as $dr){
                    if($room == $dr->name && $dr->is_danger == 1){
                        $isDanger = true;
                    }
                }
                $allRoom[] = [
                    'name' => $room,
                    'probability' => $key,
                    'is_danger' => $isDanger
                ];
            }
            return view('rooms.index')
            ->with('calibrated',$lastCalibrate)
            ->with('rooms', $allRoom);
    
        }else{
            $status = false;
            return view('rooms.index')->with('status',$status);
        }
            //dd($allRoom);
           
    }
}
