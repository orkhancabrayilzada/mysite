<?php

namespace App\Modules\admin\About\Model;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $table = 'about';

    protected $fillable = ['name','title','description','phone','age', 'email', 'occupation' ,'nationality', 'short_description', 'long_description' ,'image'];
}
