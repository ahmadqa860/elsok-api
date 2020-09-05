<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_permission extends Model
{


    protected $hidden = [
        'id', 'user_id', 'created_at', 'updated_at'
    ];
}