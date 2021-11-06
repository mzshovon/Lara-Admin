<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    public function products()
    {
        return $this->hasOne(Product::class, 'product_id', 'id');
    }

    public function  getImagePathAttribute($value)
    {
        if (file_exists(dirname(base_path()).'/'.$value)===true && $value){
            return url('/').'/'.$value;
        }else{
            return url('/').'/assets/no-image.jpg';
        }

    }
}
