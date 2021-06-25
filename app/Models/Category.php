<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function templates()
    {
        return $this->hasMany(Template::class, 'category_id', 'id');
    }


    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'templates', 'category_id', 'attribute_id')
            ->withPivot('type');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    public function father()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function subCategories()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }
}
