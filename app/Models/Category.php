<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\Product;

class Category extends Model
{
    use HasFactory;

    protected $table = ('categories');

    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'meta_title',
        'meta_keyword',
        'meta_description',
        'status',

    ];
    // public function products()
    // {
    //     return $this->hasMany(Product::class, 'category_id', 'id');
    // }

    public function advertisements()
    {
        return $this->hasMany(Advertisement::class, 'category_id');
    }

    public function pop_ads()
    {
        return $this->hasMany(Advertisement::class, 'category_id');
    }

    public function subcategory()
    {
        return $this->hasMany(Subcategory::class, 'category_id', 'id');
    }
}
