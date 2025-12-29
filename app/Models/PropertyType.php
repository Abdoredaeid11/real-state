<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyType extends Model
{
    use HasFactory;
        protected $fillable = ['name', 'name_ar'];

    // العلاقة مع العقارات
    public function properties()
    {
        return $this->hasMany(Property::class, 'property_type_id');
    }
}
