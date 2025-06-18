<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VRF_Project extends Model
{
    use HasFactory;

    protected $table  = 'vrf_projects';

    protected $fillable = [
        'project_name',
        'client_name',
        'location',
        'brand',
        'image',
        'capacity',
        'equipment_list',
        'description',
        'indoor_type',
        'outdoor_type',
        'drawings',
        'remarks',
        'start_date',
        'completed_date',
        'status'
    ];

    protected $casts = [
        'equipment_list' => 'array', // if stored as JSON in DB
        'drawings' => 'array',       // if stored as JSON
        'start_date' => 'date',
        'completed_date' => 'date',
    ];
}
