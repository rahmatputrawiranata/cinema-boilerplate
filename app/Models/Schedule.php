<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    public function studio()
    {
        return $this->belongsTo('App\Models\Studio', 'studio_id');
    }

    public function movie()
    {
        return $this->belongsTo('App\Models\Movie', 'movie_id');
    }
}
