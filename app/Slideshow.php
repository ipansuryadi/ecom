<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slideshow extends Model
{
    protected $table = 'slideshows';

    protected $fillable = [
        'image_name',
        'link',
        'title',
        'short_desc',
        'order'
    ];

}
