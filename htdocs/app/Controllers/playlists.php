<?php

namespace App\Controllers;
use App\Models\getPlaylists;
use App\Models\getPlaylistSongs;

class playlists extends BaseController
{
    public function playlists()
    {
        $playlistsModel = new getPlaylists;
        $userId = session()->get("id");
        $playlists = $playlistsModel->where('userId' , $userId)->findall();
        return view('playlists',['playlists'=>$playlists]);
    }
}
