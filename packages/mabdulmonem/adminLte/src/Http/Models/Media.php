<?php

namespace Mabdulmonem\Uploader\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'size', 'extension', 'type', 'tmp_name', 'caption', 'link', 'path'];


    public function scopeSynchMedia($query, $model)
    {
        return $this->model($model)->sync([
        $model->id => [
            'model' => get_class($model),
        ]
    ]);
    }

    public function model($model)
    {
        return $this->belongsToMany($model , 'model_media', 'media_id', 'model_id')->withPivot('model', 'caption')->withTimestamps();
    }
}
