<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'phone', 'email', 'visits_count'];
    
    public function sessions() { return $this->hasMany(Session::class); }
}
