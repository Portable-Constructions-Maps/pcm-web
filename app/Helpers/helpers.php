<?php
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use App\Worker;
use Carbon\Carbon;
use App\Location;

function setResponse($data, $status, $message) {
  return $data = [
    "status" => $status,
    "message" => $message,
    "data" => $data,
  ];
}
function getBaseUrl() {
  //local
  //return "http://10.50.0.31:8005/";
  //production
  return "http://35.202.62.247:8006/" ;
}
function mqtt(){
  $data = array(
    'server' => '35.202.62.247',
    'port'=> 1885,
    'username' => 'admin' ,
    'password' => 'password'
  );
  return $data;
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
  $data = null;
  foreach ($workers as $worker) {
    foreach ($request['devices'] as $device) {
      if($device == $worker->uuid){
        $data[] = [
          'name' => $worker->name,
          'uuid' => $worker->uuid,
          'is_trigger' => $worker->is_trigger,
        ];
      }
    }
  }
  //return dd($data);
  return $data;

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

function publishMqtt($org, $device, $status){
  $conf = mqtt();
  //dd($conf);
  $buzz = $status == 1 ? true : false;
  $data = [
    "method" =>'setAlarmStatus',
    "enabled" => $buzz 
  ];
  //dd('v1/'.$org.'/'.$device.'/request', json_encode($data), 0);
  $server   = $conf['server'];
  $port     = $conf['port'];
  $clientId = 'test-publisher';

  $mqtt = new \PhpMqtt\Client\MqttClient($server, $port, $clientId);
  $connectionSettings = (new \PhpMqtt\Client\ConnectionSettings)
        ->setUsername($conf['username'])
        ->setPassword($conf['password']);
  $mqtt->connect($connectionSettings, true);
  $mqtt->publish('v1/'.$org.'/'.$device.'/request', json_encode($data), 0);
  $mqtt->disconnect();
  //return dd($mqtt);
}
function getDevicesByLocation($org) {
    $url = getBaseUrl()."api/v1/by_location/".$org;
    try{
      $request = Http::get($url)->json();
      //return $request;
      $data = null; 
      $head = $request['locations'];
     
      foreach($head as $items){
        $location =  $items['location'];
        foreach($items['devices'] as $a){
            $timestamp = $a['timestamp'];
            $data[] = [
                  'worker' => $a['device'],
                  'active_mins' => $a['active_mins'] ,
                  'probability' => $a['probability'],
                  'timestamp' => Carbon::parse($timestamp)->diffForHumans(),
                  'first_seen' => $a['first_seen'],
                  'active_mins' => $a['active_mins'],
                  'location' => $location
              ];
          }
      }
      //return dd($data);
      if($data != null) {
        return setResponse($data, true, "ada datanya guys");
      } 
      return setResponse("",false,"kosong");
    }catch(\Exception $e){
      return setResponse("",false,"Error: connect ECONNREFUSED");
    }
}
function mergeData($data){
  $byData = $data;
  $result = null;
  $data_from_db = Location::where('org',getOrg())->get();
  foreach($data_from_db as $d) {
    foreach($byData as $bdt) {
      if($d['name'] == $bdt['location']){
        if($d['is_danger'] == 1){
          //GET STATUS DEVICE
          //DO:: Get Status Device
          //IF STATUS DEVICE false then publish mqtt to device
          
          publishMqtt(getOrg(), $bdt['uuid'], true);
        };
        $result[] = [
          'device_name' => $bdt['device_name'],
          'uuid' => $bdt['uuid'],
          'location' => $bdt['location'],
          'in_danger' => $d['is_danger'],
          'is_trigger' => $bdt['is_trigger'],
          'active_mins' => $bdt['active_mins'],
          'timestamp' => Carbon::parse($bdt['timestamp'])->diffForHumans(),
          'accuracy' => $bdt['probability']* 100 ."". "%",
        ];
      }
    }
  }
  return $result;
}
function workerGroupByArea($datas){
  $return = [];
  $devices = [];
  $area = [];
  $locations = Location::where('org',getOrg())->get();
  foreach($datas as $data) {
    foreach($locations as $location) {
      if($location['name'] == $data['location']){
        $return[] = [
          "location"  => $data['location'],
          "is_danger" => $location['is_danger'],
          "data"    => [$data]
        ];
      }
    }
  }
  return $return;
}

function workersByLocation($data, $key){
  $return = [];
  foreach($data as $val) {
      $return[$val[$key]][] = $val;
      unset($return[$val[$key]][$key]);
  }
  return $return;
}
function by_location($org){
  $url = getBaseUrl()."api/v1/by_location/".$org;
  $request =  Http::get($url)->json();
  $locations = $request['locations'];
  $devices =  Worker::where('org', $org)->get();
  $loc     = Location::where('org', $org)->get();
  foreach($locations as $location){
      $loc_device =  $location['location'];
      foreach($location['devices'] as $device){
        foreach($devices as $worker){
          if($worker->uuid == $device['device']){
            $data[] = [
              'device_name' => $worker->name,
              'uuid' => $device['device'],
              'timestamp' => $device['timestamp'],
              'probability' => $device['probability'],
              'active_mins' => $device['active_mins'],
              'first_seen' => $device['first_seen'],
              'location' => $loc_device,
              'is_trigger' => $worker->is_trigger
            ];
            
          }
        }
      }
  }
  // foreach($loc as $l){
  //   foreach($data as $dev){
  //     if($l['location'] == $dev['location']){
  //       $data_by_device_location[] = [
  //         'device_name' => $dev->device_name,
  //         'uuid' => $dev->uuid,
  //         'timestamp' => $dev->timestamp,
  //         'probability' => $dev->probability,
  //         'active_mins' => $dev->active_mins,
  //         'first_seen' => $dev->first_seen,
  //         'location' => $dev->location,
  //         'is_trigger' => $dev->is_trigger
  //       ];
  //     }
  //   }
  // }
  //return json_encode($data_by_device_location);
  //$result = group_by('location', $data);
  return $data;
  // return $data;
  // return json_encode($loc);
}
function workers_by_location($org){
  $url = getBaseUrl()."api/v1/by_location/".$org;
  $request =  Http::get($url)->json();
  $locations = $request['locations'];
  $devices =  Worker::where('org', $org)->get();
  $loc     = Location::where('org', $org)->get();
  foreach($locations as $location){
      $loc_device =  $location['location'];
      foreach($location['devices'] as $device){
        foreach($devices as $worker){
          if($worker->uuid == $device['device']){
            $data[] = [
              'device_name' => $worker->name,
              'uuid' => $device['device'],
              'timestamp' =>  Carbon::parse($device['timestamp'])->diffForHumans(),
              'probability' => $device['probability'],
              'active_mins' => $device['active_mins'],
              'first_seen' => $device['first_seen'],
              'location' => $loc_device,
              'is_trigger' => $worker->is_trigger
            ];
            
          }
        }
      }
  }
  // foreach($loc as $l){
  //   foreach($data as $dev){
  //     if($l['location'] == $dev['location']){
  //       $data_by_device_location[] = [
  //         'device_name' => $dev->device_name,
  //         'uuid' => $dev->uuid,
  //         'timestamp' => $dev->timestamp,
  //         'probability' => $dev->probability,
  //         'active_mins' => $dev->active_mins,
  //         'first_seen' => $dev->first_seen,
  //         'location' => $dev->location,
  //         'is_trigger' => $dev->is_trigger
  //       ];
  //     }
  //   }
  // }
  //return json_encode($data_by_device_location);
  //$result = group_by('location', $data);
  $result = [
    'data' => $data,
  ];
  return $result;
  // return $data;
  // return json_encode($loc);
}