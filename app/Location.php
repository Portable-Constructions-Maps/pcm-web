<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = "rooms";
    protected $fillable = [
        'name','org'
    ];
}
