<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function father()
    {
        return $this->belongsTo(Menu::class, 'menu_id', 'id');
    }

    public function subItems()
    {
        return $this->hasMany(Menu::class, 'menu_id', 'id');
    }

    // RECURSIVE ELOQUENT
    // https://stackoverflow.com/questions/26652611/laravel-recursive-relationships
    public function childrenItems()
    {
        return $this->hasMany(MenuItem::class, 'menu_item_id', 'id');
    }

    public function allChildrenItems()
    {
        return $this->childrenItems()->with('allChildrenItems');
    }
}
