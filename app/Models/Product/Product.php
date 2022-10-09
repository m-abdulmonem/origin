<?php

namespace App\Models\Product;

use App\Models\Product\Category\Category;
use App\Models\User;
use App\Models\Utils\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'has_comments', 'has_reviews', 'new', 'url', 'buy_price', 'sale_price', 'code', 'quantity', 'vendor_id', 'user_id'];


    /**
     * @return HasMany
     */
    public function variants(): HasMany
    {
        return $this->hasMany(ProductGroup::class);
    }

    /**
     * @return BelongsToMany
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'category_id');
    }

    /**
     * @return HasMany
     */
    public function codes(): HasMany
    {
        return $this->hasMany(PromoCode::class);
    }

    /**
     * @return BelongsToMany
     */
    public function media(): BelongsToMany
    {
        return $this->belongsToMany(Media::class, 'product_media', 'model_id', 'media_id')->withPivot('model', 'caption')->withTimestamps();
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
