<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $fillable = [
        'name', 'gender', 'email', 'address', 'phone', 'note'
    ];

    public function bills()
    {
        return $this->hasMany(Bill::class, 'id_customer', 'id');
    }
}