<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Company extends Model
{
    protected $fillable = [
        'id', 'name','web','description'
    ];
}
