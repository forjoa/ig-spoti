<?php namespace App\Models;

use CodeIgniter\Model;

class TrackModel extends Model {
    protected $table = 'tracks';
    protected $allowedFields = ['title', 'artist_id', 'album_id', 'duration', 'genre', 'cover'];
    
}