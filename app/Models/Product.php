<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['title', 'slug', 'description', 'image' , 'category_id',  'subcategory_id', 'price' ,'short_description', 'brand_name', 'year_old', 'alcohol_percentage' ,'banner_product' ];
      public function category()
    {
        return $this->belongsTo(ProductCategory::class, 'category_id');
    }
public function reviews()
{
    return $this->hasMany(ProductReview::class);
}
 public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }
 public function subcategory()
{
    return $this->belongsTo(Subcategory::class, 'subcategory_id');
}

}
