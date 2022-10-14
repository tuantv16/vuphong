<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    protected $fillable = ['id','url','updater','updater_date','del_flag'];
    public $timestamps = false;
}
