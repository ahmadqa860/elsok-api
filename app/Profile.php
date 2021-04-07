<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    static public function create_new($request)
    {

        $profile = new self();
        $profile->user_id = auth()->user()->id;
        $profile->identity = $request['identity'];
        $profile->name = $request['name'];
        $profile->mobile = $request['mobile'];
        $profile->city_id = $request['city_id'];
        $profile->address = $request['address'];
        $profile->save();

        if ($request['userType'] == "owner") {

            Shop_owner::create_new();

            for ($i = 2; $i < 4; $i++) {
                $permission = new User_permission;
                $permission->user_id = $profile->user_id;
                $permission->permission_id = $i;
                $permission->save();
            }
        } else {

            Seller::create_new();

            $permission = new User_permission;
            $permission->user_id = $profile->user_id;
            $permission->permission_id = 3;
            $permission->save();
        }
    }

    protected $hidden = [
        'user_id', 'id', 'created_at', 'updated_at'
    ];
}