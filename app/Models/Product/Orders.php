<?php

namespace App\Models\Product;

use App\Models\Client\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;

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
