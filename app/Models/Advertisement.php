<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advertisement extends Model
{
    use HasFactory;

    protected $table = ('advertisements');
    public function incrementReadCount()
    {
        $this->views++;
        return $this->save();
    }
    public function additional_fields()
    {
        return $this->hasMany(AdditionalField::class, 'advertisement_id', 'id');
    }

    // public function categories()
    // {
    //     return $this->belongsTo(Category::class, 'category_id');
    // }

    public function images()
    {
        return $this->hasMany(Image::class, 'advertisement_id', 'id');
    }
}
