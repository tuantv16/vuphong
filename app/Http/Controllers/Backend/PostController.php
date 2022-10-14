<?php

namespace App\Http\Controllers\Backend;

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


class PostController extends Controller
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
        $data_post = DB::table('post')
            ->select(
                'post.id'
            ,   'post.title'
            ,   'post.content'
            ,   'post.author'
            ,   'post.featured_article'
            ,   'post.mime'
            ,   'post.original_filename'
            ,   'post.filename'
            ,   'post.slug'
            ,   'category.category_nm'
            ,   'post.register'
            ,   'post.register_date'
            ,   'post.updater'
            ,   'post.updater_date'
            )
            ->leftJoin('category', 'post.category_id', '=', 'category.id')
            ->where('post.del_flg',0)
            ->orderBy('post.id','DESC')
            ->get();
        return view("backend.post.index")->with([
            'data_post' => $data_post,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories = DB::table('category')->get();
        return view("backend.post.add_post")->with([
            'categories' => $categories,
        ]);  
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
            return redirect('admin/bai-viet/them-moi')->withErrors($validator)->withInput();
        } else {  
            $info_image = $request->file('bookcover');
            $extension = $info_image->getClientOriginalExtension();
            $nameImage = $info_image->getClientOriginalName();

            Storage::disk('public')->put($info_image->getFilename().'.'.$extension,  File::get($info_image));
            Storage::disk('public')->put($nameImage,  File::get($info_image));
            $check_category  = $request->check_category;
            if($check_category = 'auto') {
                $category_id  = $request->category_id;
                $featured_article = 0;
            } else {
                $category_id = 0;
                $featured_article = $request->featured_article;
            }

            $post = new Post();
            $post->title            = $request->title;
            $post->content          = $request->content;
            $post->author           = $request->author;
            $post->category_id      = $category_id;
            $post->featured_article = $featured_article;
            $post->category_other   = 0;
            $post->monney           = $request->monney;
            $post->slug             = $request->slug;
            $post->register         = Controller::sessionEmail();
            $post->register_date    = $curTime;
            $post->updater          = Controller::sessionEmail();
            $post->updater_date     = $curTime;
            $post->del_flg          = Config::get('constants.del_flg.on');
             //image
            
            $post->mime     = $info_image->getClientMimeType();
            $post->original_filename = $info_image->getClientOriginalName();
            $post->filename = $info_image->getFilename().'.'.$extension;

            if ($post->save()) {
                $request->session()->flash('alert-success', 'Thêm dữ liệu thành công!');
                return redirect('admin/bai-viet');
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
        $upd_post = Post::where('id', $id)->first();
        $categories = DB::table('category')->get();

        foreach($categories as $key => $row) 
        {      
            $row->value_check_selected = $upd_post->category_id;
        }
         
        return view("backend.post.update_post")->with([
            'categories' => $categories,
            'upd_post' => $upd_post
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
            return redirect('admin/bai-viet/luu-cap-nhat')->withErrors($validator)->withInput();
        } else {  
            if(!empty($request->file('bookcover'))) {   //nếu tồn tại chọn file ảnh
                $info_image = $request->file('bookcover');
                $extension = $info_image->getClientOriginalExtension();
                $nameImage = $info_image->getClientOriginalName();
                Storage::disk('public')->put($info_image->getFilename().'.'.$extension,  File::get($info_image));
                Storage::disk('public')->put($nameImage,  File::get($info_image));
                $result = DB::table('post')
                    ->where("id",$id)
                    ->update([
                        "title"                => $request->title
                     ,   "content"             => $request->content
                     ,   "author"              => $request->author
                     ,   "category_id"         => $request->category_id
                     ,   "category_other"      => 0
                     ,   "slug"                => $request->slug
                     ,   "updater"             => Controller::sessionEmail()
                     ,   "updater_date"        => $curTime
                     ,   "del_flg"             => 0
                     ,   "mime"                => $info_image->getClientMimeType()
                     ,   "original_filename"   => $info_image->getClientOriginalName()
                     ,   "filename"            => $info_image->getFilename().'.'.$extension
                    ]);
            } else { //nếu không tồn tại chọn file ảnh nào thì giữ nguyên ảnh cũ
                echo $id;
                 $result = DB::table('post')
                    ->where("id",$id)
                    ->update([
                        "title"                => $request->title
                     ,   "content"             => $request->content
                     ,   "author"              => $request->author
                     ,   "category_id"         => $request->category_id
                     ,   "category_other"      => 0
                     ,   "slug"                => $request->slug
                     ,   "updater"             => Controller::sessionEmail()
                     ,   "updater_date"        => $curTime
                     ,   "del_flg"             => 0
                    ]);
            }
            if ($result) {
                $request->session()->flash('alert-success', 'Cập nhật dữ liệu thành công!');
                return redirect('admin/bai-viet');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = DB::table('post')
            ->where("post.id",$id)
            ->update([
                "del_flg" => 1
            ]);
        if ($result) {
            return response()->json([
             'status' => 'OK'
            ]);
        }
    }
}
