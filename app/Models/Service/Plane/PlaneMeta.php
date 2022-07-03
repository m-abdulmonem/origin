<?php

namespace App\Models\Service\Plane;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaneMeta extends Model
{
    use HasFactory;
    protected $fillable =['title','description','icon','plane_id'];
}
