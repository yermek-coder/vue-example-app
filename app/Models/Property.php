<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    protected $fillable = ['name', 'price', 'bedrooms', 'bathrooms', 'storeys', 'garages'];

    public function scopeSearch($query, array $filters)
    {
        return $query->when($filters['name'] ?? null, function ($query, $name) {
            $query->where('name', 'ilike', '%' . $name . '%');
        })->when($filters['bedrooms'] ?? null, function ($query, $bedrooms) {
            $query->where('bedrooms', $bedrooms);
        })->when($filters['bathrooms'] ?? null, function ($query, $bathrooms) {
            $query->where('bathrooms', $bathrooms);
        })->when($filters['storeys'] ?? null, function ($query, $storeys) {
            $query->where('storeys', $storeys);
        })->when($filters['garages'] ?? null, function ($query, $garages) {
            $query->where('garages', $garages);
        })->when($filters['price_from'] ?? null, function ($query, $price_from) {
            $query->where('price', '>=', $price_from);
        })->when($filters['price_to'] ?? null, function ($query, $price_to) {
            $query->where('price', '<=', $price_to);
        });
    }
}