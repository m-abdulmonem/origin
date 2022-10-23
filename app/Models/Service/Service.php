<?php

namespace App\Models\Service;

use App\Models\Appearance\Page;
use App\Models\User;
use App\Models\User\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Service extends Model
{
    use HasFactory;


        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'price',
        'description',
        'icon',
    ];


    public function pages()
    {
        return $this->hasMany(Page::class);
    }

    public function users(){
      return $this->belongsToMany(User::class,"service_orders",'service_id','user_id');
    }

    public function clients(){
      return $this->belongsToMany(Client::class,"service_orders",'service_id','client_id');
    }


    public function model($model)
    {
        return $this->belongsToMany($model , 'service_orders', 'service_id', 'model_id')->withTimestamps();
    }

}
