<?php

namespace App\Models\Product\Category;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','link','image','cover','category_id'];

    public function products()
    {
        return $this->belongsToMany(Category::class,'category_products','category_id','product_id');
    }
}
