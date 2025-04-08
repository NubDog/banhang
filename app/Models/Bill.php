<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;

    protected $table = 'bills';
    
    protected $fillable = [
        'date_order',
        'id_customer',
        'note',
        'payment',
        'total',
    ];

    protected $casts = [
        'date_order' => 'date',
        'total' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define relationship with Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'id_customer', 'id');
    }

    // Define relationship with BillDetail
    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'id_bill', 'id');
    }
}