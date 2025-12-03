<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $fillable = ['name', 'image'];

    public function products()
    {
        return $this->hasMany(Product::class, 'category_id');
    }
    public function subcategories()
{
    return $this->hasMany(Subcategory::class, 'category_id');
}


}
