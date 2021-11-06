<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function departments()
    {
        return $this->hasOne(Department::class, 'id', 'department_id');
    }
}
