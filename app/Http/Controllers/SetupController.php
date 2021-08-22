<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SetupController extends Controller
{
    public function index(){
        return view('setup.index');
    }
    public function store(Request $request){

        $organization = $request->organization;
        
        //update user 

        $user = User::find(auth()->user()->id);
        $user->org = $organization;
        $user->save();
        //dd($user->org);
        //$user->update();
        //dd($user);
       
        // $explode = explode('-', $oragnization);
        // $data = [
        //     'device' => $explode[0],
        //     'organization' => $explode[1],
        // ];
        createOrg($organization);
        return view('home');
    }
}
