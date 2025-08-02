<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable=[
        'image',
        'meta_title',
        'meta_description',
        'description',
        'title',
        'page_name',
        'rank',
    ];
}
