<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Commodity extends Model
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product', 'description', 'price', 'quantity', 'metric'
    ];

    /**
     * Get the type of farm product associated to commodity
     */
    public function farmProduct(){
        return $this->hasOne('App\FarmProduct', 'id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
