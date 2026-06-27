<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TripItineraryItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'trip_package_id',
        'day',
        'time',
        'sort_order',
        'title',
        'notes',
        'itemable_id',
        'itemable_type',
    ];

    protected $casts = [
        'day' => 'integer',
        'sort_order' => 'integer',
    ];

    public function package()
    {
        return $this->belongsTo(TripPackage::class, 'trip_package_id');
    }

    public function itemable()
    {
        return $this->morphTo();
    }
}
