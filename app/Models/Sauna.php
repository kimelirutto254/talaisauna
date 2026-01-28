<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sauna extends Model
{
    protected $fillable = ['branch_id', 'name', 'type', 'capacity', 'session_duration', 'price', 'status'];

    public function branch() { return $this->belongsTo(Branch::class); }
    public function sessions() { return $this->hasMany(Session::class); }
    public function pricingRules() { return $this->hasMany(PricingRule::class); }
}
