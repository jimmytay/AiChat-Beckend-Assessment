<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{

    const AVAILABLE = 0;
    const RESERVED = 1;
    const RELEASED = 2;
    const REDEEMED = 3;

    protected $fillable = [
        'customer_id', 'code', 'status','reserve_at','expired_reserve_at',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}
