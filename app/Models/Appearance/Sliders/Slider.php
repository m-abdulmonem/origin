<?php

namespace App\Models\Appearance\Sliders;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;


    protected $fillable = ['url','title','text','html','status'];

    public function actions()
    {
        return $this->hasMany(SliderAction::class);
    }
}
