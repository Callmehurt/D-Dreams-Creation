<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoGallery extends Model
{
    protected $fillable = [
        'id', 'title', 'tag', 'type', 'status', 'image', 'video_link'
    ];
}
