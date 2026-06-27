<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TripPackage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'created_by',
        'name',
        'days',
        'location_zone',
        'budget',
        'travel_types',
        'description',
        'is_active',
    ];

    protected $casts = [
        'days' => 'integer',
        'travel_types' => 'array',
        'is_active' => 'boolean',
    ];

    public function itineraryItems()
    {
        return $this->hasMany(TripItineraryItem::class)->orderBy('day')->orderBy('sort_order');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
