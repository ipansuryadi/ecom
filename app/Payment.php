<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payment';

    protected $fillable = [
    	'order_id',
    	'bank_id',
    	'bank_name',
    	'account_name',
    	'account_no',
    	'amount',
    	'status'
    ];

    public function bank(){
    	return $this->belongsTo('App\Bank','bank_id','id')->withTrashed();
    }
    public function order(){
    	return $this->belongsTo('App\Order');
    }
}
