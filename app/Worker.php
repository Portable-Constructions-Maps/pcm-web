<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worker extends Model
{
    //
    protected $table = "devices";
    protected $fillable = [
        'name', 'uuid','org'
    ];
}
