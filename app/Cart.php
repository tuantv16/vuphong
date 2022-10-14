<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use App\Post;
class Cart extends Model
{
    public $primaryKey  = 'id';
    protected $table = 'cart';
    protected $fillable = ['user_id','product_id','quantity','price','remark','register','register_date','updater','updater_date','del_flg'];
    public $timestamps = false;
    public static function getCart($userId) {
        $cart = Cart::where([
                'user_id' => $userId,
                'del_flg' => Config::get('constants.del_flg.on')
            ])
            ->orderBy('updater_date', 'DESC')
            ->get();
        return $cart;
    }


    public static function checkCart($where = []) {
        $cart = Cart::where($where)->first();
        return $cart;
    }

    public static function getCartByCondition($where = []) {
        $cart = Cart::where($where)->get();
        return $cart;
    }

    // Thông tin chi tiết sản phẩm có trong giỏ hàng
    public static function getDetailProductInCart($userId) {
        $cart = Cart::leftJoin('post', function($join) {
            $join->on('cart.product_id', '=', 'post.id');
        })
        ->select([
            'cart.id as cart_id',
            'cart.user_id',
            'cart.product_id',
            'cart.quantity',
            'cart.price',
            'cart.remark',
            'cart.register',
            'cart.register_date',
            'cart.updater',
            'cart.updater_date',
            'post.title',
            'post.content',
            'post.author',
            'post.featured_article',
            'post.original_filename',
            'post.filename',
            'post.category_id',
            'post.category_other',
            'post.slug',
            'post.classify_product'
        ])
        //leftJoin('post', ['cart.product_id', '=', 'post.id'])
        ->where([
            'cart.del_flg' => 0,
            'user_id' => $userId,
        ])
        ->get();
        return $cart; 
    }

    // Đếm số sản phẩm trong cart
    public static function countProductInCart($where) {
        $result = [];
        $totalRowsInCart = Cart::where($where)->count(); // tổng số bản ghi trong giỏ hàng lấy theo userId
        $cart = Cart::where($where)->get(); 
        $quanityProduct = 0; // tổng số lượng sản phẩm trong giỏ hàng lấy theo userId (ví dụ 1 bản ghi có 2 sản phẩm, 3 sản phẩm)
        if (!empty($cart)) {
            foreach ($cart as $row) {
                $quanityProduct += $row->quantity;
            }
        }
        $result['total_rows_in_cart'] = $totalRowsInCart;
        $result['quanity_product'] = $quanityProduct;
        return $result;
    }


}
