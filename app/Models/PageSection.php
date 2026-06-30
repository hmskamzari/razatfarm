<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class PageSection extends Model
{
    use HasTranslations;

    protected $fillable = [
        'page_id',
        'type',
        'heading',
        'body',
        'image',
        'sort_order',
    ];

    protected $translatable = ['heading', 'body'];

    public function page()
    {
        return $this->belongsTo(Page::class);
    }

    public function items()
    {
        return $this->hasMany(SectionItem::class)->orderBy('sort_order');
    }
}
