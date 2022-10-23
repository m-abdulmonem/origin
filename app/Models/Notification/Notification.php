<?php

namespace App\Models\Notification;

use App\Models\User\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $fillable =  ['title','content','model','model_id','client_id'];


    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
