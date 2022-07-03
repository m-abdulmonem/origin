<?php

namespace App\Models\Appearance;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menus extends Model
{
    use HasFactory;
    protected $table = "menus";
    protected $fillable =  ['title','parent','link','description'];
}
