<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class Commodity extends Model
{
    use Searchable;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product', 'description', 'price', 'quantity', 'metric'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
