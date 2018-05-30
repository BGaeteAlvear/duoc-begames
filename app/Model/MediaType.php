<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class MediaType extends Model
{
    protected $fillable = [
        'id', 'name', 'description'
    ];
}
