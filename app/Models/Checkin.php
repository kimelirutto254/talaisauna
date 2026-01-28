<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkin extends Model
{
    protected $fillable = ['session_id', 'checked_in_at', 'checked_out_at', 'attendant_id'];
    
    protected $casts = ['checked_in_at' => 'datetime', 'checked_out_at' => 'datetime'];

    public function session() { return $this->belongsTo(Session::class); }
    public function attendant() { return $this->belongsTo(User::class, 'attendant_id'); }
}
