<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'type',
        'developer',
        'city',
        'city_ar',
        'location_text',
        'starting_price',
        'price_currency',
        'installments_up_to',
        'min_bedrooms',
        'max_bedrooms',
        'delivery_year',
        'main_image',
        'short_description',
        'description',
        'description_ar',
        'status',
    ];

    protected $casts = [
        'starting_price' => 'decimal:2',
        'min_bedrooms' => 'integer',
        'max_bedrooms' => 'integer',
        'delivery_year' => 'integer',
        'installments_up_to' => 'integer',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class);
    }
}
