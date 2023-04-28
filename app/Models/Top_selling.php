<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Top_selling extends Model
{
    /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'top_sellings';
    public function prices()
    {
        return $this->hasMany(ProductPrice::class);
    }

    public function getPriceAttribute()
    {
        $prices = $this->prices;
        if ($prices->isEmpty()) {
            return null;
        }
        return $prices->sortByDesc('created_at')->first()->price;
    }
}