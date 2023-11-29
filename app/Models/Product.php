<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Product extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;

    protected $fillable = ['name', 'price', 'principle_id', 'category_id'];

    public function principle()
    {
        return $this->belongsTo(Principle::class, 'principle_id', 'id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function productImages()
    {
        return collect($this->getMedia('images'));
    }

}
