<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ProductOrderDetail extends Model
{
    protected $table = 'product_order_detail';
    protected $fillable = [];
    public $timestamps = false;
    public static function getOrder() {
        $order = ProductOrderDetail::where([
            'del_flg' => Config::get('constants.del_flg.on')
            ])->get();
        return $order;
    }


    public static function maxId() {
        $maxOrderId = ProductOrderDetail::max('id');
        if(empty($maxOrderId)) {
            $maxOrderId = 0;
        }
        return $maxOrderId;
    }
}
