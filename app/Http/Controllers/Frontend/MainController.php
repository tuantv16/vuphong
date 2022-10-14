<?php

namespace App\Http\Controllers\Frontend;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MainController extends AppController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
       
        $page = 'home';
        $arrCategory = $this->getCategory();
        $productFeature = $this->getProductFeatures();
    // echo '<pre>';
    //     var_dump($productFeature);
    //     die;
        return view("templates/default")->with([
            'page' => $page,
            'arrCategory' => $arrCategory,
            'productFeature' => $productFeature,
        ]);
    }

    public static function getCategory() {
        $arrCategory = [];
        $category = Category::getCategory();
        $categories = $category->toArray();
        $arrCategory = [];
        foreach($categories as $row) {
            if ($row['parent_id'] == 0) {
                $arrCategory[$row['id']] = $row;  
            }
        }

        foreach($categories as $rows) {
            if (isset($arrCategory[$rows['parent_id']])) {
                $arrCategory[$rows['parent_id']]['level2'][] = $rows;
            }     
        }

        return $arrCategory;
    }

    //Đệ quy menu 2 cấp
    public function showCategories($categories, $parent_id = 0, $char = '')
    {
        $arrCategory = [];
        foreach ($categories as $key => $item)
        {
            // Nếu là chuyên mục con thì hiển thị
            if ($item['parent_id'] == $parent_id)
            {
                // Xử lý hiển thị chuyên mục
                //$a = $parent_id."-".$item['category_nm'];
                $arr = [
                    'id' => $item['id'],
                    'parent_id' => $parent_id,
                    'category_nm' => $item['category_nm']
                ];
                $arrCategory[] = $arr;

                // Xóa chuyên mục đã lặp
                unset($categories[$key]);
                 
                // Tiếp tục đệ quy để tìm chuyên mục con của chuyên mục đang lặp
                $this->showCategories($categories, $item['id'], $char.'|---');
            }
        }

        return $arrCategory;
    }

    public function process($parent_slug, $childrent_slug) {
        $convertSlugToArray = explode("-", $childrent_slug);
        $categoryId = (int)end($convertSlugToArray);

        // Lấy danh sách các sản phẩm theo ID danh mục
        $post = Post::getPost($categoryId);

        // Lấy danh mục (vị trí ở sidebar)
        $arrCategory = $this->getCategory();

        return view("frontend/posts/post_by_category_id")->with([
            'post' => $post,
            'arrCategory' => $arrCategory 
        ]);

        // var_dump($post);
        // die;
        //echo $childrent_slug;die;
    }


    //Lấy thông tin sản phẩm nội bật
    public static function getProductFeatures() {
        $postFeatures = Post::getProductFeatures();
        if(!empty($postFeatures)) {
            $postFeatures = $postFeatures->toArray();
            return $postFeatures;
        }

    }  

}
