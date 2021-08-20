<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class SetupController extends Controller
{
    public function store(Request $request){

        $organization = $request->organization;

        //update user 

        $user = User::find(auth()->user()->id)->first();
        $user->org = $organization;
        $user->update();

        createOrg($organization);
        // $explode = explode('-', $oragnization);
        // $data = [
        //     'device' => $explode[0],
        //     'organization' => $explode[1],
        // ];
        return $user;
    }
}
