<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Culture extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'type',
        'name',
        'slug',
        'short_description',
        'description',
        'article',
        'image',
        'images',
        'is_featured',
        'is_published',
        'published_at',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'images' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $culture) {
            if (! filled($culture->slug) && filled($culture->name)) {
                $culture->slug = Str::slug($culture->name);
            }

            if ($culture->is_published && blank($culture->published_at)) {
                $culture->published_at = now();
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
}
