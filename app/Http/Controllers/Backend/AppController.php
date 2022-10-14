<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Login;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
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
