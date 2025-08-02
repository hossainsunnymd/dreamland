<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable=[
        'user_id',
        'name',
        'email',
        'bd_mobile',
        'abroad_mobile',
        'last_education',
        'prefferred_country',
        'pdf',
    ];
}
