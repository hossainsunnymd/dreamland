<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    protected $fillable=[
        'service_category_id',
        'service_description',
        'service_image',
        'rank'
    ];

    public function serviceCategory(){
        return $this->belongsTo(ServiceCategory::class);
    }
}
