<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;

class Post extends Model
{
    protected $table = 'post';
    protected $fillable = [];
    public $timestamps = false;
    public static function getPost($categoryId) {
        $post = Post::where([
            'category_id' => $categoryId,
            'del_flg' => Config::get('constants.del_flg.on')
            ])->get();
        return $post;
    }

    public static function getProductFeatures() {
        $limit = Config::get('constants.limit_product_features');
        $postFeatures = Post::where([
            'featured_article' => Config::get('constants.post.features'),
            'del_flg' => Config::get('constants.del_flg.on')
            ])
            ->limit($limit)
            ->orderBy('id', 'DESC')
            ->get();
        return $postFeatures;
    }

    public static function getProductById($listProductIds) {
        $data = Post::whereIn('id', $listProductIds)
            ->where('del_flg', Config::get('constants.del_flg.on'))
            ->orderBy('updater_date', 'DESC')
            ->get();
           
        return $data;
    }

}
