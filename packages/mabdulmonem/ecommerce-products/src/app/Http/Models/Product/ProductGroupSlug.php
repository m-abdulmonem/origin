<?php

namespace Mabdulmonem\Uploader\Http\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGroupSlug extends Model
{
    use HasFactory;

    protected $fillable = ['slug','value','product_group_id'];


    public function varients()
    {
        return $this->belongsTo(ProductGroup::class);
    }
}
