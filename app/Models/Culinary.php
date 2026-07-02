<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Culinary extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'culinaries';

    protected $fillable = [
        'name',
        'slug',
        'type',
        'short_description',
        'history',
        'description',
        'main_ingredients',
        'location_zone',
        'address',
        'maps_url',
        'images',
        'is_popular',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'main_ingredients' => 'array',
        'images' => 'array',
        'is_popular' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $culinary) {
            if (! filled($culinary->slug) && filled($culinary->name)) {
                $culinary->slug = Str::slug($culinary->name);
            }

            if ($culinary->is_published && blank($culinary->published_at)) {
                $culinary->published_at = now();
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
