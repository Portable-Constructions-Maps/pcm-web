<?php
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Worker;

function getBaseUrl() {
  //local
  //return "http://10.50.0.31:8005/";
  //production
  return "http://35.202.62.247:8005/" ;
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
  $device = Worker::where('org', $org)->first();
  $url = getBaseUrl(). 'data';
    $data = array (
        'd' => $device->uuid,
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
  //$data[] = null;
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
  //return dd($data);
  return $data;
}
 
function publishMqtt($org, $device, $status){
  $buzz = $status == 1 ? true : false;
  $data = [
    "method" =>'setAlarmStatus',
    "enabled" => $buzz 
  ];
  //dd('v1/'.$org.'/'.$device.'/request', json_encode($data), 0);
  $server   = '35.202.62.247';
  $port     = 1884;
  $clientId = 'test-publisher';

  $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
  $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
        ->setUsername("admin")
        ->setPassword("kasugawa");
  $mqtt->connect($connectionSettings, true);
  $mqtt->publish('v1/'.$org.'/'.$device.'/request', json_encode($data), 0);
  $mqtt->disconnect();
  //return dd($mqtt);
}
function publishMqttTest(){
  $data = [
    "method" =>'setAlarmStatus',
    "enabled" => false 
  ];
  $server   = '35.202.62.247';
  $port     = 1884;
  $clientId = 'test-publisher';                 

  $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
  $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
        ->setUsername("admin")
        ->setPassword("kasugawa");
  $mqtt->connect($connectionSettings, true);
  $mqtt->publish('v1/307a9eaa609/307a9eaa609-28a1656e-9df0-4c7c-af2c-cfdbc2613b5d/request', json_encode($data), 0);
  $mqtt->disconnect();
  return dd($mqtt);
}
