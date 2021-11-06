<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    public function orderdetails()
    {
        return $this->hasMany(OrderDetail::class, 'order_id', 'id');
    }

    public function shippings()
    {
        return $this->hasOne(Shipping::class, 'id', 'shipping_id');
    }

    public function users()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function payments()
    {
        return $this->hasOne(Payment::class, 'order_id', 'id');
    }
}
