<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class ContactMessage extends Model
{
    use HasFactory;

    protected $table = 'contact_messages';

    protected $fillable = [
        'first_name',
        'last_name',
        'number',
        'email',
        'message',
    ];
}
