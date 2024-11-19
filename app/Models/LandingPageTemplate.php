<?php

namespace App\Models;

use Dotlogics\Grapesjs\App\Contracts\Editable;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class LandingPageTemplate extends Model implements Editable
{

    use EditableTrait;

    protected $fillable=[
        "name",
        "gjs_data",
        "user_id",
        "description",
        "slug",
        "css_files",
        "js_files",
        "header",
        "footer"
    ];

    protected function casts(): array
    {
        return [
            'css_files' => 'array',
            'js_files' => 'array',
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function landing_pages()
    {
        return $this->hasMany(LandingPage::class);
    }

}
