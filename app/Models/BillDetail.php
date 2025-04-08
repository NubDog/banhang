<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillDetail extends Model
{
    use HasFactory;

    protected $table = 'bill_detail';
    
    protected $fillable = [
        'id_bill',
        'id_product',
        'quantity',
        'unit_price',
    ];

    protected $casts = [
        'quantity' => 'integer',
        'unit_price' => 'double',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define relationship with Bill
    public function bill()
    {
        return $this->belongsTo(Bill::class, 'id_bill', 'id');
    }

    // Define relationship with Product (assuming you have a Product model)
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product', 'id');
    }
}