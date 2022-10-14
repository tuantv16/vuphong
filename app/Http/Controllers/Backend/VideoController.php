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


class VideoController extends Controller
{
    public function __construct() {
    	$this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_video = DB::table('video')
            ->select(
                'video.id'
            ,   'video.url'
            ,   'video.del_flg'
            )
            ->where('video.del_flg',0)
            ->first();
        return view("backend.video.update_video")->with([
            'upd_video' => $data_video,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $curTime = new \DateTime();
         $result = DB::table('video')
            ->where("id",$id)
            ->update([
                 "url"             => $request->url
            ,    "updater"         => Controller::sessionEmail()
            ,    "updater_date"    => $curTime
            ,    "del_flg"         => 0
            ]);
          
        if ($result) {
            $request->session()->flash('alert-success', 'Video được cập nhật thành công!');
            return redirect('admin/video');
        }
        
    }

}
