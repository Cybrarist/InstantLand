<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Dotlogics\Grapesjs\App\Contracts\Editable;
use Dotlogics\Grapesjs\App\Traits\EditableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class LandingPage extends Model implements Editable

{
    use HasFactory, EditableTrait;


    protected $fillable=[
        "name",
        "gjs_data",
        "user_id",
        "description",
        "css_files",
        "js_files",
        "header",
        "footer",
        "campaign_id",
        "link",
        "AB_testing"
    ];

    protected function casts(): array
    {
        return [
            'css_files' => 'array',
            'js_files' => 'array',
            'status' => StatusEnum::class
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }

    public function subscribers(): BelongsToMany
    {
        return $this->belongsToMany(Subscriber::class);
    }

}
