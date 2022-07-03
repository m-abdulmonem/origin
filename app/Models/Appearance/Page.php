<?php

namespace App\Models\Appearance;

use App\Models\Service\Service;
use App\Models\User;
use App\Models\Utils\Media;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;


    protected $fillable = ['title' , 'content', 'permalink','status','published_at','featured_image','has_comments','parent','is_reviewed','user_id','password','service_id'];

    protected $dates = ['published_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function media()
    {
        return $this->belongsToMany(Media::class,'product_media','model_id','media_id')->withPivot('model', 'caption')->withTimestamps();
    }
}
