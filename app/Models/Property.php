<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class Property extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'description_ar',
        'price',
        'type',
        'status',
        'property_type_id',
        'city',
        'city_ar',
        'address',
        'address_ar',
        'latitude',
        'longitude',
        'map_url',
        'bedrooms',
        'bathrooms',
        'area',
        'floor_plan',
        'broker_id',
        'category_id',
        'user_id',
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($property) {
            if (Auth::check() && in_array(Auth::user()->role, [User::ROLE_BROKER, User::ROLE_USER])) {
                $property->status = 'pending';
            }
        });

        static::updating(function ($property) {
            if (Auth::check() && in_array(Auth::user()->role, [User::ROLE_BROKER, User::ROLE_USER])) {
                $property->status = 'pending';
            }
        });
    }


    public function scopeTypeId($query, $id)
    {
        if ($id) {
            $query->where('property_type_id', $id);
        }
    }

    public function scopeCity($query, $city)
    {
        if ($city) {
            $query->where('city', 'LIKE', "%{$city}%");
        }
    }

    public function scopePriceMin($query, $min)
    {
        if ($min) {
            $query->where('price', '>=', $min);
        }
    }

    public function scopePriceMax($query, $max)
    {
        if ($max) {
            $query->where('price', '<=', $max);
        }
    }

    public function scopeStatus($query, $status)
    {
        if ($status) {
            $query->where('status', $status);
        }
    }

    public function scopeSearch($query, $term)
    {
        if ($term) {
            $query->where(function ($q) use ($term) {
                $q->where('title', 'like', "%{$term}%")
                  ->orWhere('description', 'like', "%{$term}%")
                  ->orWhere('address', 'like', "%{$term}%");
            });
        }
    }
    public function type()
    {
        return $this->belongsTo(PropertyType::class, 'property_type_id');
    }

    public function broker()
    {
        // broker_id points to users table with role broker
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }
    public function features()
    {
        return $this->belongsToMany(Feature::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
