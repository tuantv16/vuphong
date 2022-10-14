<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class AppController extends Controller
{
    public function __construct()
    {
        // $user = '';
        // if (Session::has('username')) {
        //     $user = Session::get('username');
        // }
        // $this->username = $user;
    }
}
