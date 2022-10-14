<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Login;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
class DashboardController extends AppController
{
	public function __construct() {
    	$this->middleware('auth');
    }
    
    public function dashboard(Request $request) {
        //return view('backend.dashboard')->with('user',$user);
        return view('backend.dashboard');
    }
}
