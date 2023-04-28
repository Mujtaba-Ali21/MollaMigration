<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Top_selling;

class ProductPrice extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'top_sellings_prices';
    use HasFactory;
    
    public function top_selling()
    {
        return $this->belongsTo(Top_selling::class);
    }
}