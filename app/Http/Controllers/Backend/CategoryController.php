<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;


class CategoryController extends Controller
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
        $categories = DB::table('category')
        ->where('category.del_flg',0)
        ->orderBy('category.id','ASC')
        ->get();
        return view("backend.category.index")->with([
            'categories' => $categories,
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
        return view("backend.category.add_category")->with([
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
        $category_nm = $request->category_nm;
        $parent_id = $request->parent_id;
        $slug = $request->slug;
        
        $category = new Category();
        $category->category_nm      = $request->category_nm;
        $category->parent_id        = $request->parent_id;
        $category->slug             = $request->slug;
        $category->register         = 'admin';
        $category->register_date    = $curTime;
        $category->updater          = 'admin';
        $category->updater_date     = $curTime;
        $category->del_flg          = 0;
        if ($category->save()) {
            $request->session()->flash('alert-success', 'Thêm dữ liệu thành công!');
            return redirect('admin/danh-muc');
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
        $upd_category = Category::where('id', $id)->first();
        $categories = DB::table('category')->get();

        foreach($categories as $key => $row) 
        {      
            $row->value_check_selected = $upd_category->parent_id;
        }
         
        return view("backend.category.update_category")->with([
            'categories' => $categories,
            'upd_category' => $upd_category
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
            'required' => 'Tên danh mục không được để trống'
        ];
        $validator = Validator::make($request->all(), [ // <---
            'category_nm' => 'required',
        ],$messages);
        if ($validator->fails()) {
            // Dữ liệu vào không thỏa điều kiện sẽ thông báo lỗi
            return redirect('admin/danh-muc/luu-cap-nhat')->withErrors($validator)->withInput();
        } else {  
            $result = DB::table('category')
                ->where("id",$id)
                ->update([
                     "category_nm"         => $request->category_nm
                 ,   "parent_id"           => $request->parent_id
                 ,   "slug"                => $request->slug
                 ,   "updater"             => Controller::sessionEmail()
                 ,   "updater_date"        => $curTime
                 ,   "del_flg"             => 0
                ]);
        
            if ($result) {
                $request->session()->flash('alert-success', 'Cập nhật dữ liệu thành công!');
                return redirect('admin/danh-muc');
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
        $result = DB::table('category')
            ->where("category.id",$id)
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
