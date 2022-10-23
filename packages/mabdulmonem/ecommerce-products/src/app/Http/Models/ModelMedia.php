<?php

namespace Mabdulmonem\Uploader\Http\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelMedia extends Model
{
    use HasFactory;

    protected $fillable = ['caption','model','model_id','media_id'];
}
