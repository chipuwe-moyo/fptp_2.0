<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FarmProduct extends Model{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'product_type'
    ];

    /**
     * Get the product that belongs to the commodity.
     */
    public function commodity(){
        $this->belongsTo('App\Commodity', 'id', 'produce_id');
    }
}
