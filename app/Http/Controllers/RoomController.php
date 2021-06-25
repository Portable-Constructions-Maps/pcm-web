<?php

namespace App\Http\Controllers;

use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RoomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    public function unDanger(Request $request){
        $roomName  = $request['room'];
        $room = Room::where('name',$roomName)->first();
        $room->is_danger = 0;
        $room->update();

        return json_encode([
            'data' => $room,
            'status' => 'success'
        ]);
        
    }
    public function store(Request $room)
    {
        $rooms = Room::where('name',$room['room'])->first();
        $roomName  = $room['room'];
        if($rooms == null){
            $newRoom = new Room;
            $newRoom->name = $roomName;
            $newRoom->is_danger = 1;
            $newRoom->save();
            return json_encode(
                [
                    'data' => $newRoom,
                    'success' => true
                ]);
        }else {
            return json_encode(
                [
                    'data' => $rooms,
                    'success' => true
                ]);
        }
    }
    public function showDangerRooms(){
        $rooms = Room::all();
        return json_encode($rooms);
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
