<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Commodity extends Model
{
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
        return $this->hasOne('App\FarmProduct', 'id', 'produce_id');
    }
}
