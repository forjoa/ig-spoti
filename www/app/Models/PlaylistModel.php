<?php namespace App\Models;

use CodeIgniter\Model;

class PlaylistModel extends Model {
    protected $table = 'playlists';
    protected $allowedFields = ['user_id', 'name', 'cover', 'tracks'];
}