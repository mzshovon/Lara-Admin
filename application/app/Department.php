<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    public function categories()
    {
        return $this->hasMany(Category::class, 'department_id', 'id');
    }

    public function brands()
    {
        return $this->hasMany(Brand::class, 'department_id', 'id');
    }
}
