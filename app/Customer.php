<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = ['address', 'email', 'phone', 'user_id'];

    public function user() {
    	return $this->belongsTo('App\User');
    }

    public function order() {
    	return $this->hasMany('App\Models\Order');
    }
}
