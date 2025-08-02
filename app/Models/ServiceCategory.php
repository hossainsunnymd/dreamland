<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    protected $fillable=[
        'service_name',
        'service_title',
        'image'
    ];
}
