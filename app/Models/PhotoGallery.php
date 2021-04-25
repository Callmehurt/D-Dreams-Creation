<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhotoGallery extends Model
{
    protected $fillable = [
      'id', 'title', 'tag', 'type', 'status', 'image'
    ];
}
