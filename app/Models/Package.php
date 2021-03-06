<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    protected $fillable = [
        'id', 'title', 'description', 'image', 'amount', 'user_id', 'status'
    ];
}
