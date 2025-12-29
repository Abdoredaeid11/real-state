<?php

namespace App\Services;

use App\Models\Property;
use Illuminate\Support\Facades\DB;

class PropertyService
{
public function list($filters)
{
    return Property::query()
        ->typeId($filters['type_id'] ?? null)
        ->city($filters['city'] ?? null)
        ->priceMin($filters['min_price'] ?? null)
        ->priceMax($filters['max_price'] ?? null)
        ->with(['type', 'user'])
        ->paginate(12);
}
    public function store($data)
    {
        return Property::create($data);
    }

    public function update($property, $data)
    {
        $property->update($data);
        return $property;
    }

    public function delete($property)
    {
        $property->delete();
    }
}
