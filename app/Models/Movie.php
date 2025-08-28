<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $fillable = ['imdb_id', 'title', 'year', 'poster_url'];

    public function users()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}