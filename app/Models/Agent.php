<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'profile_image',
        'bio',
        'social_links',
        'status',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];
}

