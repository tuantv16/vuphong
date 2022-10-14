<?php

namespace App\Http\Controllers\Frontend;

use App\Post;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Frontend\MainController;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function layouts($page_static)
    {
        
        switch($page_static) {
            case 'login': 
                $data = 'string login';
                return view("templates.login")->with([
                    'data' => $data
                ]);
                break;

            case 'blog':
                $arrCategory = MainController::getCategory();
                
                $page = 'blog';
                return view("templates.blog")->with([
                    'page' => $page,
                    'arrCategory' => $arrCategory,
                ]);
                break;
            case 'blog-single':
                $arrCategory = MainController::getCategory();
                
                $page = 'blog';
                return view("templates.blog-single")->with([
                    'page' => $page,
                    'arrCategory' => $arrCategory,
                ]);
                    break;
                
            case 'contact-us': 
                $dataChat = DB::table('chat')
                ->where('chat.del_flg',0)
                ->get();
                return view("templates.contact-us")->with([
                   
                    'dataChat' => $dataChat->toArray()
                ]);
                break;
            
            case 'checkout':
                $data = 'data test';
                return view("templates.checkout")->with([
                    'data' => $data
                ]);
                break;

            case 'cart':
                if (!Session::has('email')) {
                    return redirect('/login.html');
                }
                // Lấy thông tin các sản phẩm trong giỏ hàng
                $cart = CartController::getCart();

                // echo '<pre>';
                // var_dump($productIds);
                // die('thuc hien cart22');
                // Lấy thông tin chi tiết của sản phẩm
                $dataCart = [];
                if (!empty($cart['detailCart'])) {
                    $productIds = array_column($cart['detailCart'], 'product_id');
                    $dataCart = Post::getProductById($productIds);
                    $dataCart =  $dataCart->toArray();
                }

                // echo '<pre>';
                // var_dump($dataCart);
                // die('xinchao22');

                if (!empty($dataCart)) {
                    foreach($dataCart as $item) {
                        $cart['detailCart'][$item['id']]['detailProduct'] = $item;
                    }
                } 
                
                return view("templates.cart")->with([
                    'cart' => $cart
                ]);
                break;

            case 'shop':
                $data = 'data test';
                return view("templates.shop")->with([
                    'data' => $data
                ]);
                break;
            case 'product-details':
                $data = 'data test';
                return view("templates.product-detail")->with([
                    'data' => $data
                ]);
                break;

            case 'confirm':
                $confirmData = CartController::confirm();
                // Thông tin khách hàng
                $infoUser = CartController::getUser();
                    // var_dump('--------');
                    // echo '<pre>';
                    // var_dump($infoUser);
                    // die;   
                return view("templates.confirm")->with([
                    'infoCart' => $confirmData['infoCart'],
                    'quantityArr' => $confirmData['quantityArr'],
                    'infoUser' => $infoUser
                ]);
                break;

            case 'success':
                $data = 'data test';
                return view("templates.success")->with([
                    'data' => $data
                ]);
                break;
                

            default:
                echo '';
                break;
        }    
    }
}
