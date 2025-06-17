<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryTable extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'project_name',
        'project_location',
        'status'
    ];
}
