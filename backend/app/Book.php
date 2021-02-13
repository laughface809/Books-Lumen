<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $guarded = [];
    protected $appends = ['photo_url'];

    public function getPhotoUrlAttribute()
    {
        return url('book/' . $this->photo);
    }
}
