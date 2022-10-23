<?php

namespace Mabdulmonem\Uploader\Http\Models\Product;

use App\Models\User\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

    protected $table = "orders";
    protected $fillable = ['code','comments','quantity','buy_price','sale_price','discount','discount_type','status','client_id','products_id'];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }

    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
}
