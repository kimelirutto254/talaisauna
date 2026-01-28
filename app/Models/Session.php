<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    protected $table = 'sauna_sessions';

    protected $fillable = [
        'branch_id', 'sauna_id', 'pricing_rule_id', 'customer_id', 'start_time',
        'expected_end_time', 'actual_end_time', 'status', 'user_id',
        'total_amount', 'overtime_fee'
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'expected_end_time' => 'datetime',
        'actual_end_time' => 'datetime',
    ];

    public function branch() { return $this->belongsTo(Branch::class); }
    public function sauna() { return $this->belongsTo(Sauna::class); }
    public function pricingRule() { return $this->belongsTo(PricingRule::class); }
    public function customer() { return $this->belongsTo(Customer::class); }
    public function payments() { return $this->hasMany(Payment::class); }
    public function checkin() { return $this->hasOne(Checkin::class); }
}
