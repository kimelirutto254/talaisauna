<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['session_id', 'amount', 'method', 'reference', 'received_by', 'status'];
    
    public function session() { return $this->belongsTo(Session::class); }
    public function receiver() { return $this->belongsTo(User::class, 'received_by'); }
}
