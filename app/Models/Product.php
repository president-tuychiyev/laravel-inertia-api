<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $appends = ['name', 'desc', 'spec'];

    public function brand()
    {
        return $this->hasOne(Brand::class, 'id', 'brand_id');
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function media()
    {
        return $this->hasOne(Media::class, 'id', 'media_id');
    }

    public function category()
    {
        return $this->hasMany(Attach::class, 'product_id', 'id')->with('category');
    }

    public function getNameAttribute()
    {
        $column = "name_" . app()->getLocale();
        return $this->{$column};
    }

    public function getDescAttribute()
    {
        $column = "desc_" . app()->getLocale();
        return $this->{$column};
    }

    public function getSpecAttribute()
    {
        $column = "spec_" . app()->getLocale();
        return $this->{$column};
    }

    public function scopeUndeleted(Builder $query): void
    {
        $query->where('isDeleted', false);
    }
}
