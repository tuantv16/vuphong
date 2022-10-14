<?php

namespace App\Http\Controllers\Backend;

use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class LinkController extends Controller
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
        $data_link = DB::table('link')
            ->select(
                'link.id'
            ,   'link.url'
            ,   'link.mime'
            ,   'link.original_filename'
            ,   'link.filename'
            ,   'link.register'
            ,   'link.register_date'
            ,   'link.updater'
            ,   'link.updater_date'
            )
            ->where('link.del_flg',0)
            ->orderBy('register_date','DESC')
            ->get();
        return view("backend.link.index")->with([
            'data_link' => $data_link,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view("backend.link.add_link");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $curTime = new \DateTime();
        $messages = [
            'required' => 'Hình ảnh chưa được chọn',
            'image' => 'Định dạng không cho phép',
            'max' => 'Kích thước file quá lớn',
            'mimes' => 'Định dạng file không đúng (file phải có phần mở rộng là jpeg,png,jpg,gif,svg)'

        ];
        $validator = Validator::make($request->all(), [ // <---
            'bookcover' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],$messages);
    
       
        if ($validator->fails()) {
            // Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
            return redirect('admin/lien-ket/them-moi')->withErrors($validator)->withInput();
        } else {  
            $info_image = $request->file('bookcover');
            $extension = $info_image->getClientOriginalExtension();
            Storage::disk('public')->put($info_image->getFilename().'.'.$extension,  File::get($info_image));

            $link = new Link();
            $link->url            = $request->url;
            $link->register         = Controller::sessionEmail();
            $link->register_date    = $curTime;
            $link->updater          = Controller::sessionEmail();
            $link->updater_date     = $curTime;
            $link->del_flg          = 0;
             //image
            
            $link->mime     = $info_image->getClientMimeType();
            $link->original_filename = $info_image->getClientOriginalName();
            $link->filename = $info_image->getFilename().'.'.$extension;

            if ($link->save()) {
                $request->session()->flash('alert-success', 'Thêm dữ liệu thành công!');
                return redirect('admin/lien-ket');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $upd_link = Link::where('id', $id)->first();

        return view("backend.link.update_link")->with([
            'upd_link' => $upd_link
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
        $messages = [
            'image' => 'Định dạng không cho phép',
            'max' => 'Kích thước file quá lớn',
            'mimes' => 'Định dạng file không đúng (file phải có phần mở rộng là jpeg,png,jpg,gif,svg)'
        ];
        $validator = Validator::make($request->all(), [ // <---
            'bookcover' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ],$messages);

       // var_dump($request->file('bookcover'));die;
        if ($validator->fails()) {
            // Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
            return redirect('admin/lien-ket/luu-cap-nhat')->withErrors($validator)->withInput();
        } else {  
            if(!empty($request->file('bookcover'))) {   //nếu tồn tại chọn file ảnh
                $info_image = $request->file('bookcover');
                $extension = $info_image->getClientOriginalExtension();
                Storage::disk('public')->put($info_image->getFilename().'.'.$extension,  File::get($info_image));
              
                $result = DB::table('link')
                    ->where("id",$id)
                    ->update([
                         "url"                  => $request->url
                     ,   "updater"             => Controller::sessionEmail()
                     ,   "updater_date"        => $curTime
                     ,   "del_flg"             => 0
                     ,   "mime"                => $info_image->getClientMimeType()
                     ,   "original_filename"   => $info_image->getClientOriginalName()
                     ,   "filename"            => $info_image->getFilename().'.'.$extension
                    ]);
            } else { //nếu không tồn tại chọn file ảnh nào thì giữ nguyên ảnh cũ
                echo $id;
                 $result = DB::table('link')
                    ->where("id",$id)
                    ->update([
                         "url"                 => $request->url
                     ,   "updater"             => Controller::sessionEmail()
                     ,   "updater_date"        => $curTime
                     ,   "del_flg"             => 0
                    ]);
            }
            if ($result) {
                $request->session()->flash('alert-success', 'Cập nhật dữ liệu thành công!');
                return redirect('admin/lien-ket');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $result = DB::table('link')
            ->where("link.id",$id)
            ->update([
                "del_flg" => 1
            ]);
        if ($result) {
            $request->session()->flash('alert-success', 'Xóa dữ liệu thành công!');
            return redirect('admin/lien-ket');
        }
    }
}
