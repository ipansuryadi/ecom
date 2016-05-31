<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    /**
     * @var string
     */
    protected $table = 'orders';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'address_id',
        'total_ongkir',
        'ongkir_real',
        'no_resi',
        'kurir',
        'status',
        'total'
    ];


    /**
     * An Order can have many products
     *
     * @return $this
     */
    public function orderItems() {
        return $this->belongsToMany('App\Product')->withPivot('qty', 'price', 'reduced_price', 'total', 'total_reduced');
    }

    public function address(){
        return $this->belongsTo('App\Address');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    // public static function boot(){
    //     $orders = Order::all();
    //     foreach ($orders as $value) {
    //         foreach ($value->orderItems as $element) {
    //             $element->pivot->product_id;
    //         }
    //     }
    // }

}