<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Media extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected function src(): Attribute
    {
        return Attribute::make(get: fn($value, $attributes) => config('app.url') . $value);
    }
}
