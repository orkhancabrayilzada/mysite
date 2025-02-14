<?php

namespace App\Modules\admin\Projects_categories\Model;

use App\Modules\admin\Portfolio\Model\Portfolio;
use Illuminate\Database\Eloquent\Model;

class Project_Category extends Model
{
    protected $fillable = [''];

    public function portfolio()
    {
        $this->belongsTo(Portfolio::class);
    }
}
