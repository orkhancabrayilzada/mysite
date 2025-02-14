<?php

namespace App\Modules\admin\Resume\Model;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $fillable = ['title', 'position', 'description', 'start_date', 'end_date', 'type'];

}
