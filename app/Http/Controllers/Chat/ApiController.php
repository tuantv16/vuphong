<?php

namespace App\Http\Controllers\Chat;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Cart;
use App\User;
use App\Chat;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{

    public function sendDataChat(Request $request)
    {
      
        $dataInputs = $request->all();
        $username = $dataInputs['username'];
        $message = $dataInputs['message'];

        $chat = new Chat();
        $chat->username = $username;
        $chat->message = $message;
        $chat->register = Auth::user()->name;
        $chat->register = Auth::user()->name;
        $chat->register_date = new \DateTime();;
        $chat->updater = Auth::user()->name;
        $chat->updater_date = new \DateTime();;
        $chat->del_flg = Config::get('constants.del_flg.on');
        $chat->save();

        $data = [
            'username' => $username,
            'message' => $message
        ];

        if ($chat) {
            return response()->json([
             'status' => 'OK',
             'data' => $data
            ]);
        }
        
    }
}