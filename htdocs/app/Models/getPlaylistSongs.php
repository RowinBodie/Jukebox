<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class getPlaylistSongs extends Model{
    protected $table = 'playlistsongs'; 
    protected $allowedFields = [
        'id',
        'songId',
        'playlistId'
    ];
}