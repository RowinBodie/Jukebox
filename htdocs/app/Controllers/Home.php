<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\getPlaylists;

class Home extends BaseController
{
    public function loadGeneralPage(){
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $getSongs = $getSongsModel->findAll();
        $getGenres = $getGenresModel->findAll();
        $totalWatchDuration = 0;
        $time = "00:00";
        if(isset($_SESSION['queue']) ){
            foreach($_SESSION['queue'] as $session => $sessionSong){
                $getSongForQueue = $getSongsModel->where("id", $sessionSong)->first();
                $totalWatchDuration += $getSongForQueue["duration"];
            }
            $minutes = floor($totalWatchDuration / 60);
            $seconds = ($totalWatchDuration % 60);
            $time = sprintf("%02d:%02d", $minutes, $seconds);
            return view('index',["songs"=>$getSongs,"genres"=>$getGenres,"time"=>$time]);
        }else{
            session()->set("queue", []);
            return view('index',["songs"=>$getSongs,"genres"=>$getGenres,"time"=>$time]);
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

    public function loadSavingPlaylist(){
        return view('save');
    }

    public function savePlaylist(){
        $getPlaylists;
        $name = $this->request->getVar('name');
        $userName = session()->get('name');

        session()->remove("queue");
        return redirect()->back();
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