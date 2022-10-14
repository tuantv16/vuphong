<?php

namespace App\Http\Controllers\Backend;

use App\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ChatController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function chat()
    {

        $dataChat = DB::table('chat')
        ->where('chat.del_flg',0)
        ->get();

        return view("backend.chat.index")->with([
            'dataChat' => $dataChat,
        ]);

      
    }

}
