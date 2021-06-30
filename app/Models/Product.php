<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    /*
    public function templates()
    {
        return $this->hasMany(TemplateValue::class, 'product_id', 'id');
    }
    */

    public function templates()
    {
        return $this->belongsToMany(Template::class, 'template_values', 'product_id', 'template_id')
            ->withPivot([
                'value',
                'id'
            ]);
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
