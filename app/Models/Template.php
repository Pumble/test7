<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    use HasFactory;

    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Attribute::class, 'category_id', 'id');
    }

    public function values()
    {
        return $this->hasMany(TemplateValue::class, 'template_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'template_values', 'template_id', 'product_id')
            ->withPivot('value');
    }
}
