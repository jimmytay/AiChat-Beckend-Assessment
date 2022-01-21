<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = [
        'first_name', 'last_name', 'gender','date_of_birth', 'contact_number', 'email',
    ];

    public function purchase_transaction()
    {
        return $this->hasMany(PurchaseTransaction::class);
    }

    public function voucher()
    {
        return $this->hasOne(Voucher::class,'customer_id','id');
    }
}
