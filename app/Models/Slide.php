<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    use HasFactory;

    protected $table = 'slide';
    
    protected $fillable = [
        'image',
        'link',
    ];

    // Disable timestamps as they don't appear in the table structure
    public $timestamps = false;
}