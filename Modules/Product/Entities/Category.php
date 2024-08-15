<?php

namespace Modules\Product\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products() {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }

    /**
     * Get the total number of categories.
     *
     * @return int
     */
    public static function getTotalCategories()
    {
        return self::count();
    }
}
