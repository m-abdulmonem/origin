<?php

namespace App\Models\Appearance\Sliders;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SliderAction extends Model
{
    use HasFactory;
    protected $fillable = ['slug','value','slider_id'];


    public function slider()
    {
        return $this->belongsTo(Slider::class);
    }
}
