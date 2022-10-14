<?php

namespace App\Http\Controllers\Frontend;

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
use App\ProductOrder;
use App\ProductOrderDetail;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    // Lấy thông tin đơn hàng
    public function getOrder() {
        $order = ProductOrder::getOrder();
        $order = $order->toArray();
        echo '<pre>';
        var_dump($order);
        die('testtuantv12234');
    }

    //Thêm mới đơn hàng
    public function saveOrder(Request $request)
    {
        $inputData = $request->all();
        $curTime = new \DateTime();

        $userId = 0;
        if (Session::has('cart')) {
            $cart = Session::get('cart'); 
            $userId = $cart['user_id'];
        }

        $cartDB = Cart::getCartByCondition([
            'user_id' => $userId,
            'del_flg' => Config::get('constants.del_flg.on')
        ]);
        $cartDB = $cartDB->toArray();
        // echo '<pre>222';
        // var_dump(Session::get('cart'));
        // die('test1234234');
        DB::beginTransaction();
       
       $orderCode = date_format($curTime,'Ymd');
       $maxId = ProductOrder::maxId();
       $orderCode = 'DH'.$orderCode.'0106'.(string)$maxId;
        $order = new ProductOrder();
        $order->order_code = $orderCode;
        $order->user_id = $userId;
        $order->address = $inputData['address'];
        $order->phone = $inputData['phone'];
        $order->remark = $inputData['remark'];
        $order->total_quantity = isset($cart['totalProduct']) ? $cart['totalProduct'] : 0;
        $order->total_price = isset($cart['total_price']) ? $cart['total_price'] : 0;
        $order->status = 3;
        $order->register = Auth::user()->name;
        $order->register_date = $curTime;
        $order->updater = Auth::user()->name;
        $order->updater_date = $curTime;
        $order->del_flg = Config::get('constants.del_flg.on');
        
        $order->save();   

        foreach($cartDB as $row) {
            
            // echo '<pre>';
            // var_dump($maxId);
            // die('test12234');
            //insert vào Cart trong Database
            $orderDetail = new ProductOrderDetail();
            $orderDetail->price = $inputData['phone'];
            $orderDetail->order_code = $orderCode;
            $orderDetail->cart_id = $row['id'];
            $orderDetail->user_id = $userId;
            $orderDetail->product_id = $row['product_id'];
            $orderDetail->price = (int)$row['price'] * (int)$row['quantity'] ;
            $orderDetail->status = 3;
            $orderDetail->register = Auth::user()->name;
            $orderDetail->register_date = $curTime;
            $orderDetail->updater = Auth::user()->name;
            $orderDetail->updater_date = $curTime;
            $orderDetail->del_flg = Config::get('constants.del_flg.on');
            
            $orderDetail->save();   
        }
            // Commit the transaction
        DB::commit();


        //Insert xong thì update del_flg trong bảng cart thành 1 và xóa session : CHƯA LÀM

        // if (Session::has('email')) { // Tồn tại session nghĩa là đã login. Vì khi login đã khởi tạo session email
           
        //     if (Session::has('cart')) {
        //         $cart = Session::get('cart'); 
        //         $cart['user_id'] = Auth::user()->id;
        //         //  echo '<pre>';
        //         // var_dump($cart);
        //         // die(23423423);
        //     } else {
        //         $cart = Cart::getCart(Auth::user()->id);
        //         $cart = $cart->toArray();
        //         $quantity = 0;
        //         foreach($cart as $row) {
        //             $quantity += (int)$row['quantity'];
        //         }
        //         $cart['totalProduct'] = $quantity;
        //         $cart['user_id']  = Auth::user()->id;
        //         Session::put('cart', $cart); 
        //     }
           
        // }

        return response()->json([
            'status' => Config::get('constants.status.ok'), // status done
            'cart' => json_encode($order)
        ]);

    }


}
