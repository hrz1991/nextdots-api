<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    public function createAdmin()
    {

        $_new = new User();

        $_new->rol_id = 1;
        $_new->firstname = "Hector";
        $_new->lastname = "Rodriguez";
        $_new->email = "rhector773@gmail.com";
        $_new->password = Hash::make("123456");

        // $_new->save();

        echo "crear user";
    }
}