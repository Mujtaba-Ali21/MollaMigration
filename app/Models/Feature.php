<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    public function prices()
    {
        return $this->hasMany(FeaturesPrice::class);
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