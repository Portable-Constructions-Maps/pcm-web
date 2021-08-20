<?php
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Worker;

function getBaseUrl() {
  //local
  return "http://10.50.0.31:8005/";
  //production
  //return "http://34.70.96.106:8005/" ;
}

function getOrg(){
    return auth()->user()->org;
}

function createOrg($org){
    $url = getBaseUrl(). 'data';
    $data = array (
        'd' => $org,
        'f' => $org,
        's' => 
        array (
          'bluetooth' => 
          array (
            '' => '',
          ),
          'wifi' => 
          array (
            '' => '',
          ),
        ),
    );
    $client = new Client();
    //return $data;
    return $client->request('POST', $url, [
        'json' => $data,
        // 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        // 'body' => json_encode($data)
    ]);
}
function createArea($area, $org){
  $url = getBaseUrl(). 'data';
    $data = array (
        'd' => $org,
        'f' => $org,
        'l' => $area,
        's' => 
        array (
          'bluetooth' => 
          array (
            '' => '',
          ),
          'wifi' => 
          array (
            '' => '',
          ),
        ),
    );
    $client = new Client();
    //return $data;
    return $client->request('POST', $url, [
        'json' => $data,
        // 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
        // 'body' => json_encode($data)
    ]);
}

function createDevice($name,$org) {
  $url = getBaseUrl(). 'data';
  $data = array (
      'd' => $name,
      'f' => $org,
      's' => 
      array (
        'bluetooth' => 
        array (
          '' => '',
        ),
        'wifi' => 
        array (
          '' => '',
        ),
      ),
  );
  $client = new Client();
  //return $data;
  return $client->request('POST', $url, [
      'json' => $data,
      // 'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
      // 'body' => json_encode($data)
  ]);
}

function getDevices() {
  $host =  getBaseUrl(). "api/v1/devices/".getOrg();
  $request = Http::get($host)->json();
  $workers = Worker::all();
  foreach ($workers as $worker) {
    foreach ($request['devices'] as $device) {
      if($device == $worker->uuid){
        $data[] = [
          'name' => $worker->name,
          'uuid' => $worker->uuid,
        ];
      }
    }
  }
  return $data;
}