<?php

namespace App\Models\Product;

use App\Models\Product\Category\Category;
use App\Models\Utils\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title','description','has_cooments','has_reviews','new','url','buy_price','sale_price','code','quntity','vendor_id','user_id'];



    public function varients()
    {
        return $this->hasMany(ProductGroup::class);
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class,'category_products','product_id','category_id');
    }

    public function codes()
    {
        return $this->hasMany(PromoCode::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class,'product_media','model_id','media_id')->withPivot('model', 'caption')->withTimestamps();
    }
}
