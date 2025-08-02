<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CountryDetail extends Model
{
    protected $fillable=['image','title','description','country_id','key_points'];
}
