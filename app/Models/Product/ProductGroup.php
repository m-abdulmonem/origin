<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroup extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','type','product_id'];


    public function product()
        {
            return $this->belongsTo(Product::class);
        }


        public function slugs()
        {
            return $this->hasMany(ProductGroupSlug::class);
        }

}
