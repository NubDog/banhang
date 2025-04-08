<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    
    protected $fillable = [
        'name',
        'id_type',
        'description',
        'unit_price',
        'promotion_price',
        'image',
        'unit',
        'new',
    ];

    protected $casts = [
        'unit_price' => 'float',
        'promotion_price' => 'float',
        'new' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Define relationship with ProductType
    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'id_type', 'id');
    }

    // Define relationship with BillDetail
    public function billDetails()
    {
        return $this->hasMany(BillDetail::class, 'id_product', 'id');
    }
}