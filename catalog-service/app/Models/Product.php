<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['nama_app', 'harga', 'durasi_hari', 'snk'];


public function accounts() {
    return $this->hasMany(Account::class);
    }
}
