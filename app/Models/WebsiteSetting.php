<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'site_name',
        'logo_path',
        'banner_path',
        'about',
        'contact_phone',
        'contact_email',
        'contact_address',
        'social_links',
        'footer_text',
    ];

    protected $casts = [
        'social_links' => 'array',
    ];

    public static function current(): self
    {
        return static::query()->first() ?? static::query()->create();
    }
}
