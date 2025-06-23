<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    protected $table = 'categories';

    protected $fillable = [
        'title',
        'description',
        'path',
        'position',
        'image',
        'type',
        'status',
    ];


    public function getImageUrlAttribute()
    {
        return asset('storage/' . $this->image);
    }
}
