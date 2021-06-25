<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Carbon\Carbon;

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
        $room = $result['accuracy_breakdown'];
        $timestamp = $result['last_calibration_time'];
        $lastCalibrate =  Carbon::createFromTimestamp($timestamp)->diffForHumans();
       
        return view('rooms.index')
            ->with('calibrated',$lastCalibrate)
            ->with('rooms', $room);
    }
}
