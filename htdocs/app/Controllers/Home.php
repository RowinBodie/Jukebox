<?php

namespace App\Controllers;
class Home extends BaseController
{
    public function loadGeneralPage(){
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $getSongs = $getSongsModel->findAll();
        $getGenres = $getGenresModel->findAll();
        if(isset($_SESSION['queue']) ){
            return view('index',["songs"=>$getSongs,"genres"=>$getGenres]);
        }else{
            session()->set("queue", []);
            return view('index',["songs"=>$getSongs,"genres"=>$getGenres]);
        }        
    }

    public function loadGenre($id){
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $getSongs = $getSongsModel->where("genre", $id)
                                    ->findAll();
        $getGenres = $getGenresModel->findAll();
        return view('index',["songs"=>$getSongs,"genres"=>$getGenres]);
    }

    public function addQueueSong($id){
        session()->push("queue", [$id]);
        return redirect()->back();
    }

    public function clearQueueSong(){
        session()->remove("queue");
        return redirect()->back();
    }

    public function removeQueueSong($id){
        $queue = session()->get("queue");
        var_dump($queue);
        foreach($queue as $position=>$item){
            if($position == $id){
                unset($queue[$position]);
            }
        }
        echo "<br>";
        var_dump($queue);
        session()->set("queue", $queue);
        return redirect()->back();
    }

    public function index()
    {
        return view('index');
    }
}