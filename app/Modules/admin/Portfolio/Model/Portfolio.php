<?php

namespace App\Modules\admin\Portfolio\Model;

use App\Modules\admin\Projects_categories\Model\Project_Category;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    protected $fillable = [''];

    public function categories()
    {
        $this->hasOne(Project_Category::class, 'id', 'fk_project_categories');
    }
}
