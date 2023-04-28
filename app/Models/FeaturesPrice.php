<?php

namespace App\Models;

use App\Models\Feature;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeaturesPrice extends Model
{
    use HasFactory;
    
    public function feature()
    {
        return $this->belongsTo(Feature::class);
    }
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'features_prices';
}
