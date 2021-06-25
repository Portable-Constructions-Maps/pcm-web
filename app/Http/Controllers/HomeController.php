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
        return view('home');
    }
    public function room(){
        $url = "http://34.70.96.106:8005/api/v1/efficacy/testing";
        $request = Http::get($url)->json();
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
        //dd($allRoom);
        return view('rooms.index')
            ->with('calibrated',$lastCalibrate)
            ->with('rooms', $allRoom);
    }
}
