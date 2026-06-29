<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Destination extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'destination_category_id',
        'name',
        'slug',
        'short_description',
        'description',
        'location_zone',
        'address',
        'maps_url',
        'opening_hours',
        'ticket_price',
        'facilities',
        'images',
        'is_featured',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'ticket_price' => 'integer',
        'facilities' => 'array',
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $destination) {
            if (! filled($destination->slug) && filled($destination->name)) {
                $destination->slug = Str::slug($destination->name);
            }

            if ($destination->is_published && blank($destination->published_at)) {
                $destination->published_at = now();
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function resolveRouteBinding($value, $field = null)
    {
        if (is_numeric($value)) {
            return static::query()->where('id', (int) $value)->firstOrFail();
        }

        return parent::resolveRouteBinding($value, $field);
    }

    public function category()
    {
        return $this->belongsTo(DestinationCategory::class, 'destination_category_id');
    }

    protected function mapsEmbedUrl(): Attribute
    {
        return Attribute::get(function () {
            $mapsUrl = trim((string) $this->maps_url);
            $address = trim((string) $this->address);

            if ($mapsUrl !== '' && (Str::contains($mapsUrl, '/maps/embed') || Str::contains($mapsUrl, 'output=embed'))) {
                return $mapsUrl;
            }

            if ($address !== '') {
                return 'https://www.google.com/maps?q='.urlencode($address).'&output=embed';
            }

            if ($mapsUrl !== '') {
                return 'https://www.google.com/maps?q='.urlencode($mapsUrl).'&output=embed';
            }

            return null;
        });
    }
}
