<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VideoGame extends Model
{
    use HasFactory;

    protected $table = 'video_games';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'release_date',
        'genre'
    ];
}
