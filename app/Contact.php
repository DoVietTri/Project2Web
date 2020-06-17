<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contacts';

    protected $fillable = ['message', 'status', 'user_id'];

    public function user() {
    	return $this->belongsTo('App\User');
    }
}
