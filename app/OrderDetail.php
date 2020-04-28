<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $fillable = ['price', 'quantity', 'product_id', 'order_id'];

    public function order() {
    	return $this->hasMany('App\Order');
    }

    public function product(){
    	return $this->belongsTo('App\Product');
    }
}
