<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'price',
        'regular_price',
        'size',
        'refrigerant',
        'general',
        'capacity',
        'power',
        'model',
        'unit',
        'type',
        'image'
    ];
}
