<?php

namespace App\Helper;

use App\User;
use Illuminate\Support\Facades\Auth;

class UserAccess
{
    public static function getRole()
    {
        $role = User::where('id', '=', Auth::user()->id)->first();

        if ($role)
        return $role->level;
    }
}
