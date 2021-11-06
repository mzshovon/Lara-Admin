<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function departments()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
