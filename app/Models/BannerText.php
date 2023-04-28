<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BannerText extends Model
{
    use HasFactory;

    public function banner()
    {
        return $this->belongsTo(Banner::class);
    }
}
