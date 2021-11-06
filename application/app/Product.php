<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categories()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function brands()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function productimages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function pricecalculate($old_price, $current_price)
    {
        //$percentage = ($old_price - $current_price)/$old_price*100;
        $percentage = number_format(($old_price - $current_price)/$old_price*100, 1);
        return $percentage;
    }

    public function coupons()
    {
        return $this->hasOne(GetCoupon::class, 'product_id', 'id');
    }

}
