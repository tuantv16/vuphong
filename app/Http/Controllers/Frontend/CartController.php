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
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

   
    //Lấy thông tin cart từ session login (Viết trong hàm init, mới bắt đầu vào mỗi trang)
    public function infoCart(Request $request)
    {
        $cart = [];
    
        //$cart['totalProduct'] = 0;
        if (Session::has('email')) { // Tồn tại session nghĩa là đã login. Vì khi login đã khởi tạo session email
           
            if (Session::has('cart')) {
                $cart = Session::get('cart'); 
                $cart['user_id'] = Auth::user()->id;
                //  echo '<pre>';
                // var_dump($cart);
                // die(23423423);
            } else {
                $cart = Cart::getCart(Auth::user()->id);
                $cart = $cart->toArray();
                $quantity = 0;
                foreach($cart as $row) {
                    $quantity += (int)$row['quantity'];
                }
                $cart['totalProduct'] = $quantity;
                $cart['user_id']  = Auth::user()->id;
                Session::put('cart', $cart); 
            }
           
        }

        return response()->json([
            'status' => Config::get('constants.status.ok'), // status done
            'cart' => json_encode($cart)
        ]);

    }

    //Update giỏ hàng khi click sự kiện
    public function updateCart(Request $request)
    {

        // Chưa check mã sản phẩm không tồn tại thì hiện thông báo lỗi
        $data = $request->all();
        $product_id = (int)$data['product_id'];
        $price = $data['price'];
    
        // Trường hợp sau khi login xong
        if (Session::has('email')) {
            $emailSession =  Session::get('email');
            $dataCart = Session::get('cart');
            $dataCart['email'] = $emailSession;
            $dataCart['user_id'] = Auth::user()->id;
            // Trường hợp giỏ hàng chưa có sản phẩm nào thì khởi tạo giỏ hàng
            $totalProduct = 0;
           
            if(empty($dataCart['detailCart'])) {
                $dataCart = (array)$dataCart;
                $dataCart['detailCart'][$product_id] = [
                    'product_id' => $product_id,
                    'quantity' => 1,
                    'price' => $price
                ];

                // echo '<pre>';
                // var_dump($dataCart);
                // die(23423423);
                //echo 222;die;
                Session::put('cart', $dataCart); // Lưu thông tin giỏ hàng vào session
                $totalProduct = 1;
            } else { // Trường hợp giỏ hàng đã tồn tại ít nhất 1 sản phẩm
                foreach($dataCart['detailCart'] as $key => $row) {
           
                    // Kiểm tra Trường hợp giỏ hàng có mã sản phẩm trùng nhau thì cập nhật số lượng
                    if (isset($dataCart['detailCart'][$product_id]) && $row['product_id'] == $product_id) {
                       // echo 1;die;
                        $dataCart['detailCart'][$product_id]['product_id'] = $row['product_id'];
                        $dataCart['detailCart'][$product_id]['quantity'] = $row['quantity'] + 1;
                        $dataCart['detailCart'][$product_id]['price'] = $row['price'];
                        
                    } 
                    // else {   // Kiểm tra Trường hợp giỏ hàng có mã sản phẩm mới (không trùng nhau) thì thêm mới 1 sản phẩm vào giỏ hàng.
                      
                    //     $dataCart['detailCart'][$product_id] = [
                    //         'product_id' => $product_id,
                    //         'quantity' => 1,
                    //         'price' => $price
                    //     ];
                    // }

                    if (!isset($dataCart['detailCart'][$product_id]) && $row['product_id'] != $product_id) {
                            $dataCart['detailCart'][$product_id] = [
                            'product_id' => $product_id,
                            'quantity' => 1,
                            'price' => $price
                        ];
                         
                     } 

                }
                
                foreach($dataCart['detailCart'] as $item) {
                    if (isset($item['quantity'])) {
                        $totalProduct += $item['quantity'];
                    }
                }
               
                $dataCart['totalProduct'] = $totalProduct;

                // Thêm sản phẩm vào database
                //$this->addCart($dataCart);
                //for để lấy ra tổng
                $dataCart['flag_login'] = 1;
                Session::put('cart', $dataCart); // Lưu thông tin giỏ hàng vào session
            }
           
            $cart = Session::get('cart');
            return response()->json([
                'status' => Config::get('constants.status.ok'), // status done
                'cart' => json_encode($cart)
            ]);
        } else {
            return response()->json([
                'status' => Config::get('constants.status.not_login'), // not_login: 1001
                'url' => Config::get('constants.url_page.login')
            ]);
        }

    }

    // public function addCart($data) {
        
    // }

    // Lấy thông tin cart ở màn hình cart.html
    public static function getCart()
    {
        // Lấy thông tin giỏ hàng trong session
        $cartSession = Session::get('cart');

        // echo '<pre>';
        // var_dump($cartSession);
        // var_dump('----------------------');
        // die('thuchien222');
                
        if (!isset($cartSession['user_id']) || empty($cartSession['user_id'])) {
            echo 'Lỗi không lấy được user_id từ session cart'; die;
        }
        
        $cartDB = Cart::getCart($cartSession['user_id']);
        $cartDB = $cartDB->toArray();

        // Xử lý chia các trường hợp xảy ra, so sanh session và db rồi insert hoặc update bản ghi
        $infoCart = CartController::proccessCart($cartSession, $cartDB);

        // Gán lại giá trị session, data lấy trong DB
        $cartSession['detailCart'] = $infoCart;
        Session::put('cart', $cartSession);

        return $cartSession; 
    }

    public static function proccessCart($cartSession, $cartDB) {
        $curTime = new \DateTime();

        // echo '<pre>';
        // var_dump($cartSession);die;
        
        // TH1 - Giỏ hàng session: có sản phẩm Và trong DB Cart: không có sản phẩm nào
        if (!empty($cartSession['detailCart']) && empty($cartDB)) {
            //var_dump($cartSession);die;
            $infoUser = Auth::user()->name;
           
            try {
                // Begin a transaction
                DB::beginTransaction();
                foreach($cartSession['detailCart'] as $product) {
                    //insert vào Cart trong Database
                    $cart = new Cart();
                    
                    $cart->user_id = $cartSession['user_id'];
                    $cart->product_id = $product['product_id'];
                    $cart->quantity = $product['quantity'];
                    $cart->price = $product['price'];
                    $cart->remark = '';
                    $cart->register = $infoUser;
                    $cart->register_date = $curTime;
                    $cart->updater = $infoUser;
                    $cart->updater_date = $curTime;
                    $cart->del_flg = Config::get('constants.del_flg.on');
                   
                    $cart->save();   
                }
                 // Commit the transaction
                DB::commit();

            } catch (\Exception $e) {
                DB::rollback();
                 // and throw the error again.
                throw $e;
            }

        }

        // TH1 - Giỏ hàng session: có sản phẩm Và trong DB giỏ hàng: có sản phẩm
        if (!empty($cartSession['detailCart']) && !empty($cartDB)) {
            //var_dump($cartSession);die;
            $infoUser = Auth::user()->name;
            
            try {
                // Begin a transaction
                DB::beginTransaction();
                foreach($cartSession['detailCart'] as $product) {

                    $cartUp = [
                        'quantity' => $product['quantity'],
                        'price' => $product['price'],
                        'remark' => 'remark',
                        'updater' => $infoUser,
                        'updater_date' => $curTime
                    ];

                    $infoCartUp = DB::table('cart')
                    ->where([
                            'del_flg' => Config::get('constants.del_flg.on'),
                            'user_id' => (int)$cartSession['user_id'],
                            'product_id' => (int)$product['product_id']
                    ])->first();

                    if ($infoCartUp) { // update 

                        $infoCartUp = DB::table('cart')
                        ->where([
                                'del_flg' => Config::get('constants.del_flg.on'),
                                'user_id' => (int)$cartSession['user_id'],
                                'product_id' => (int)$product['product_id']
                        ])
                        ->update($cartUp);
                    } else { // tạo mới
                       
                        $cart = new Cart();
                        $cart->user_id = $cartSession['user_id'];
                        $cart->product_id = $product['product_id'];
                        $cart->quantity = $product['quantity'];
                        $cart->price = $product['price'];
                        $cart->remark = '';
                        $cart->register = $infoUser;
                        $cart->register_date = $curTime;
                        $cart->updater = $infoUser;
                        $cart->updater_date = $curTime;
                        $cart->del_flg = Config::get('constants.del_flg.on');

                        $cart->save();   
                    }
                    
                     
                }
                 // Commit the transaction
                DB::commit();
            } catch (\Exception $e) {
                DB::rollback();
                 // and throw the error again.
                throw $e;
            }

            // echo '<pre>';
            // var_dump($cartSession);
            // var_dump('----------------------');
            // var_dump($cartDB);
            // die('thuchien222');

        }

        $infoCart = Cart::getCart($cartSession['user_id']);
        $infoCart = $infoCart->toArray();
        $cartConvert = [];
        if (!empty($infoCart)) {
            foreach ($infoCart as $row) {
                $cartConvert[$row['product_id']] = $row;
                $cartConvert[$row['product_id']]['cart_id'] = $row['id'];
                // thành tiền = Số lượng x đơn giá
                if ($row['quantity'] != 0 && $row['price'] != 0) {
                    $cartConvert[$row['product_id']]['totalPrice'] = (int)$row['price'] * $row['quantity'];
                }
               
            }
        }
       return $cartConvert;
    }

    //update bảng cart trong database. Thao tác trên màn ../cart.html
    public function updateTableCart(Request $request) {
        $userId= Auth::user()->id;
        $infoUser = Auth::user()->name;
        $email = Auth::user()->email;
        $infoCart = $request->all();
        $curTime = new \DateTime();
        if (!empty($infoCart['item'])) {
            // Begin a transaction
            try {
                //DB::beginTransaction();

                // echo '<pre>';
                // var_dump($infoCart['item']);
                // die;

                // Begin - Lấy thông tin data cart, trường hợp input data đầu vào có product id không khớp trong db thì sẽ xóa
                $queryGetCart = Cart::getCart($userId);
                $queryGetCart = $queryGetCart->toArray();
                $infoDataCart = [];
                if (!empty($queryGetCart)) {
                    foreach($queryGetCart as $item) {
                        $infoDataCart[$item['product_id']] = $item;
                    }
                }
                // End - Lấy thông tin data cart, trường hợp input data đầu vào có product id không khớp trong db thì sẽ xóa

                $requestDataIds= array_column($infoCart['item'], 'product_id'); // request data
                $dbDataIds = array_column($queryGetCart, 'product_id');
                $dataDel = array_diff($dbDataIds, $requestDataIds); // Mảng chưa những product cần xóa


                // Delete
                if (!empty($dataDel)) {
                    foreach ($dataDel as $rowDel) {
                        DB::table('cart')->where([
                            'user_id' => $userId,
                            'product_id' => (int)$rowDel,
                            'del_flg' => Config::get('constants.del_flg.on')
                        ])->delete();
                    }
                }
                

                //$infoCart['item'] : Dũ liệu lấy lên từ giao diện trang cart.html
                foreach($infoCart['item'] as $row) {
                    $where = [
                        'user_id' => $userId,
                        'product_id' => (int)$row['product_id'],
                        'del_flg' => Config::get('constants.del_flg.on')
                    ];
                    $queryCart = Cart::checkCart($where);

                    if(isset($arrProductIdsDelete[$row['product_id']])) {
                        echo $arrProductIdsDelete[$row['product_id']].'|';
                    }

                    //Thêm mới sản phẩm vào giỏ hàng
                    // if (empty($queryCart)) {
                    //         $cart = new Cart();
                    //         $cart->user_id = $userId;
                    //         $cart->product_id = (int)$row['product_id'];
                    //         $cart->quantity = (int)$row['quantity'];
                    //         $cart->price = (int)$row['price'];
                    //         $cart->remark = '';
                    //         $cart->register = $infoUser;
                    //         $cart->register_date = $curTime;
                    //         $cart->updater = $infoUser;
                    //         $cart->updater_date = $curTime;
                    //         $cart->del_flg = Config::get('constants.del_flg.on');
                    // }

                    //Cập nhật số lượng vào giỏ hàng
                    if (!empty($queryCart)) { 
                        //echo 333;die;
                        $cartUp = [
                            'quantity' => (int)$row['quantity'],
                            'price' => (int)$row['price'],
                            'remark' => 'remark',
                            'updater' => $infoUser,
                            //'updater_date' => $curTime
                        ];
                        DB::table('cart')->where($where)->update($cartUp);
                        
                    }    
                } //end for

                // Gán lại session
                $dataCart = Cart::getCartByCondition([
                    'user_id' => $userId,
                    'del_flg' => Config::get('constants.del_flg.on')
                ]);
                $dataCart = $dataCart->toArray();
            
                $cart['email'] = $email;
                $cart['user_id'] = $userId;
                $cartTmp = [];
                $quantity = 0;
                $totalPrice = 0;
                //$cart['totalPrice222'] = $totalPrice;
               
                if(!empty($dataCart)) {
                    foreach($dataCart as $rows) {
                        $quantity += (int)$rows['quantity'];
                        $priceProduct = (int)$rows['quantity'] * (int)$rows['price']; //Tổng giá của 1 sản phẩm: Công thức : Giá * số lượng
                        $totalPrice += $priceProduct; //Tổng giá của các sản phẩm: Công thức : Tổng của (Giá * số lượng)
                        $cartTmp[] = [
                            'product_id' => $rows['product_id'],
                            'quantity' => $rows['quantity'],
                            'price' => $rows['price'],
                            'remark' => $rows['remark'],
                            'register' => $rows['register'],
                            'register_date' => $rows['register_date'],
                            'updater' => $rows['updater'],
                            'updater_date' => $rows['updater_date'],
                        ];
  
                    }   
                }


              
                $cart['detailCart'] = $cartTmp;
                $cart['totalProduct'] = $quantity;
                $cart['totalPrice'] = $totalPrice;
                // var_dump('--------');
                // echo '<pre>';
                // var_dump($cart);
                // die;
                Session::put('cart', $cart); 
                
              
            } catch (\Exception $e) { 
                //DB::rollback();
                 // and throw the error again.
                throw $e;
            }

            // Xóa những sản phẩm trong giỏ hàng (trường hợp sản phẩm bị xóa ở ngoài giao diện) - tuantv - Phần Chưa làm

            // Thực hiện lưu thông tin giỏ hàng tuantv - Phần Chưa làm
        }
       
        return response()->json([
            'status' => Config::get('constants.status.ok'), // not_login: 1001
            //'url' => Config::get('constants.url_page.login')
        ]);

    }

    public static function confirm() {
        $result = [];
        $userId = Auth::user()->id;
        $infoCart = Cart::getDetailProductInCart([
            'user_id' => $userId,
            'del_flg' => Config::get('constants.del_flg.on')
        ]);
        $infoCart = $infoCart->toArray();
        $result['infoCart'] = $infoCart;

        $quantityArr = Cart::countProductInCart([
            'user_id' => $userId,
            'del_flg' => Config::get('constants.del_flg.on')
        ]);

        $result['quantityArr'] = $quantityArr;
      
        return $result;

    }

    public static function getUser() {
        $userId = Auth::user()->id;
        $infoUser = User::getUser([
            'id' => $userId,
            //'del_flag' => Config::get('constants.del_flg.on')
        ]);

        $infoUser = $infoUser->toArray();
        return $infoUser;
    }

}
