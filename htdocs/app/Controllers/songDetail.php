<?php

namespace App\Controllers;



class songDetail extends BaseController
{
    // load song details page
    public function loadSongDetail($id){
        $getSongsModel = new \App\Models\getSongs;
        $getSongs = $getSongsModel->where("id", $id)->findAll();
        return view('songDetail',["songs"=>$getSongs]);
    }
}