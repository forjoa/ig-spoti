<?php
namespace App\Models;

use CodeIgniter\Model;

class TrackModel extends Model
{
    protected $table = 'tracks';
    protected $allowedFields = [
        'id',
        'name',
        'cover',
        'artist_id',
        'artist_name',
        'album_id',
        'album_name',
        'duration',
        'player_url',
        'playlist_id'
    ];
}