<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable=[
        "email",
        "data",
    ];

    protected $casts=[
        "data" => "json"
    ];

    public function landing_pages()
    {
        return $this->belongsToMany(LandingPage::class);
    }
}
