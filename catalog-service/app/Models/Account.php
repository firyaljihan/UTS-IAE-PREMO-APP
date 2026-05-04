<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $fillable = [
    'product_id',
    'email_premium',
    'password_premium',
    'profile_name',
    'pin',
    'status'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
