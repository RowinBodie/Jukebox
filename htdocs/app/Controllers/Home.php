<?php

namespace App\Controllers;



class Home extends BaseController
{
    public function loadGeneralPage(){
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $getSongs = $getSongsModel->findAll();
        $getGenres = $getGenresModel->findAll();
        return view('index',["songs"=>$getSongs,"genres"=>$getGenres]);
    }

    public function loadGenre($id){
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $getSongs = $getSongsModel->where("genre", $id)
                                  ->findAll();
        $getGenres = $getGenresModel->findAll();
        return view('index',["songs"=>$getSongs,"genres"=>$getGenres]);
    }

    public function index()
    {
        return view('index');
    }
}