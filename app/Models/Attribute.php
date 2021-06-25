<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    public function templates()
    {
        return $this->hasMany(Template::class, 'attribute_id', 'id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'templates', 'attribute_id', 'category_id')
            ->withPivot('type');
    }

    public function group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
}
