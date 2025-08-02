<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $fillable=[
        'name',
        'title',
        'country_id',
        'image',
        'rank'
    ];
}
