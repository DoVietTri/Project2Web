<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = ['code_order', 'name', 'address', 'email', 'phone', 'money', 'date_created', 'message', 'status', 'user_id'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function orderdetail(){
    	return $this->belongsTo('App\OrderDetail');
    }
}
