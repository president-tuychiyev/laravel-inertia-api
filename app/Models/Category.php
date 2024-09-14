<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['name'];

    public function child()
    {
        return $this->hasMany(Category::class, 'id', 'parent_id');
    }

    public function getNameAttribute()
    {
        $column = "name_" . app()->getLocale();
        return $this->{$column};
    }
}
