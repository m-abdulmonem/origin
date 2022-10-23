<?php

namespace App\Models\Service\Plane;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plane extends Model
{
    use HasFactory;

    protected $fillable = ['title','price','description','most_popular','model','model_id'];

    public function meta()
    {
        return $this->hasMany(PlaneMeta::class);
    }

    public function model($model)
    {
        return $this->belongsToMany($model , 'plane_meta', 'plane_id', 'model_id')->withPivot('title', 'description','icon')->withTimestamps();
    }
}
