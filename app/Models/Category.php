<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories(): HasMany
    {
        return $this->hasMany(Category::class)->with('categories');
    }
}
