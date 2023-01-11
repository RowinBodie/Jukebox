<?php 
namespace App\Models;  
use CodeIgniter\Model;
  
class getPlaylists extends Model{
    protected $table = 'playlists'; 
    protected $allowedFields = [
        'id',
        'name',
        'userId'
    ];
}