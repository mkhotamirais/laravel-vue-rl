<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $fillable = ["name", "slug", "price", "policy", "information", "banner", "category"];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getRouteKeyName()
    {
        return "slug";
    }


    public function scopeFilter($query, array $filters)
    {
        if ($filters['q'] ?? false) {
            $search = str_replace('-', ' ', request('q'));
            $query->where('name', 'like', '%' . $search . '%');
        }

        if ($filters['rentalcat'] ?? false) {
            $query->where('category', 'like', '%' . request('rentalcat') . '%');
        }
    }
}
