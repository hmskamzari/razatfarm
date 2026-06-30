<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class SectionItem extends Model
{
    use HasTranslations;

    protected $fillable = [
        'page_section_id',
        'image',
        'heading',
        'body',
        'value',
        'link_url',
        'link_label',
        'sort_order',
    ];

    protected $translatable = ['heading', 'body', 'link_label'];

    public function section()
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }
}
