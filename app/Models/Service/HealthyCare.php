<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HealthyCare extends Model
{
    use HasFactory;

    protected $fillable = ['title','price','description','icon'];


    public function orders()
    {
        return $this->belongsToMany(Service::class,'service_orders','model_id','service_id')->withTimestamps();
    }
}
