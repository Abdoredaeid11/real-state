<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'reservation_id',
        'amount',
        'payment_method',
        'payment_method_ar',
        'payment_date',
        'status',
        'reference',
        'updated_by',
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}

