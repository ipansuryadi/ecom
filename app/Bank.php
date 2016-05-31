<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bank extends Model
{
	use SoftDeletes;

    protected $table = 'bank';
    
    protected $fillable = [
    'bank_name',
    'account_name',
    'account_no'
    ];

    protected $dates = ['deleted_at'];
}
