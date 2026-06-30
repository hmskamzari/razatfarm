<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Spatie\Translatable\HasTranslations;

class SiteSetting extends Model
{
    use HasTranslations;

    protected $fillable = [
        'phone_primary',
        'phone_secondary',
        'phone_tertiary',
        'email',
        'address',
        'visit_hours',
        'support_hours',
        'map_embed_url',
        'social_links',
        'footer_copyright',
    ];

    protected $translatable = ['address', 'visit_hours', 'support_hours', 'footer_copyright'];

    protected $casts = [
        'social_links' => 'array',
    ];

    public static function current(): self
    {
        return Cache::rememberForever('site_settings', function () {
            return self::firstOrCreate(['id' => 1]);
        });
    }

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget('site_settings'));
    }
}
