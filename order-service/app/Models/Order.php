<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
   protected $fillable = [
        // 'id',
        'user_id',
        'app_id',
        'app_name',
        'price',
        'qty',
        'total_price',
        'status',
        'qris_url',
        'expired_at'
    ];

    public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
