<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MonthlyAd extends Model
{
    public function products()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }

    public function  getImagePathAttribute($value)
    {
        if (file_exists(dirname(base_path()).'/'.$value)===true && $value){
            return url('/').'/'.$value;
        }

        else{
            return url('/').'/assets/no-image.jpg';
        }
    }
}
