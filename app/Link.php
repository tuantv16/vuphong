<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'link';
    protected $fillable = ['url','mime','original_filename','filename','del_flg'];
    public $timestamps = false;
}
