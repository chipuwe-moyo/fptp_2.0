<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Scout\Searchable;

class Commodity extends Model
{
    use Searchable;
    use Notifiable;

    public $asYouType = true;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product', 'description', 'price', 'quantity', 'metric', 'photo', 'town', 'province', 'country'
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...

        return $array;
    }
}
