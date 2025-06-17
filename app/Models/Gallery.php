<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [
        'title',
        'description',
        'image',
        'project_name',
        'project_location',
        'status'
    ];
    protected $casts = [
        'title' => 'string',
        'description' => 'string',
        'image'            => 'string',
        'project_name'     => 'string',
        'project_location' => 'string',
        'status'           => 'string',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    protected $attributes = [
        'status' => 'active',
    ];
}
