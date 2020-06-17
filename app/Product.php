<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['name', 'alias', 'price', 'promotional', 'quantity', 'image', 'description', 'status', 'product_pay', 'category_id'];

    public function category() {
    	return $this->belongsTo('App\Category');
    }

    public function pimages() {
    	return $this->hasMany('App\ProductImage');
    }

    public function orderdetail() {
    	return $this->hasMany('App\OrderDetail');
    }
}
