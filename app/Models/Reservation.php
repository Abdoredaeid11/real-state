<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'broker_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'check_in',
        'check_out',
        'status',
        'expected_value',
        'notes',
        'notes_ar',
        'updated_by',
    ];

    public function property()
    {
        return $this->belongsTo(Property::class);
    }

    public function broker()
    {
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
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
                $q->where('customer_name', 'like', "%{$term}%")
                    ->orWhere('customer_phone', 'like', "%{$term}%")
                    ->orWhere('customer_email', 'like', "%{$term}%");
            });
        }
    }
}

