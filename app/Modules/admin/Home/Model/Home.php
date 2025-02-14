<?php

namespace App\Modules\admin\Home\Model;

use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    protected $fillable = ['title','description','image','experience','projects','clients','status'];
}
