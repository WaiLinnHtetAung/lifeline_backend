<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'photo', 'principle_id'];

    public function principle()
    {
        return $this->belongsTo(Principle::class, 'principle_id', 'id');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class);
    }

    public function imgUrl()
    {
        if ($this->photo) {
            return asset('storage/images/' . $this->photo);
        } else {
            return asset('default.png');
        }
    }
}
