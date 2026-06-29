<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Accommodation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category',
        'name',
        'slug',
        'location_zone',
        'address',
        'purchase_link',
        'price_per_night',
        'facilities',
        'maps_url',
        'images',
        'is_popular',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'price_per_night' => 'decimal:2',
        'facilities' => 'array',
        'images' => 'array',
        'is_popular' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $accommodation) {
            if (! filled($accommodation->slug) && filled($accommodation->name)) {
                $accommodation->slug = Str::slug($accommodation->name);
            }

            if ($accommodation->is_published && blank($accommodation->published_at)) {
                $accommodation->published_at = now();
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
