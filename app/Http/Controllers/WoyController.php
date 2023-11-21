<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WoyController extends Controller
{
    public function home_admin()
    {

        return view('admin.home');
    }

    public function home_user()
    {
        return view('user.homeUser');

    }

}
