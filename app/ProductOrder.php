<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class ProductOrder extends Model
{
    protected $table = 'product_order';
    protected $fillable = [];
    public $timestamps = false;
    public static function getOrder() {
        $order = ProductOrder::where([
            'del_flg' => Config::get('constants.del_flg.on')
            ])->get();
        return $order;
    }

    public static function maxId() {
        $maxOrderId = ProductOrder::max('id');  
        if(empty($maxOrderId)) {
            $maxOrderId = 1;
        } else {
            $maxOrderId += 1;
        }
        return $maxOrderId;
    }


}
