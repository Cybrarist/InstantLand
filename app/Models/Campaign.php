<?php

namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;


class Campaign extends Model
{
    use HasFactory;

    protected $fillable=[
        "name",
        "description",
        "link",
        "status",
        "start_at",
        "end_at",
        "user_id"
    ];

    protected function casts(): array
    {
        return [
            "status" => StatusEnum::class,
            'start_at' => 'date',
            'end_at' => 'date',
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function landing_pages()
    {
        return $this->hasMany(LandingPage::class);
    }

    public function subscribers(): HasManyThrough
    {
        return $this->hasManyThrough(Subscriber::class, LandingPage::class);
    }

}
