<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingRule extends Model
{
    protected $fillable = [
        'sauna_id',
        'price_type',
        'price',
    ];

    public function sauna()
    {
        return $this->belongsTo(Sauna::class);
    }
}
