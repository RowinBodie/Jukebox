<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\getPlaylists;
use App\Models\getPlaylistSongs;

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
        $totalWatchDuration = 0;
        $getSongs = $getSongsModel->where("genre", $id)
                                    ->findAll();
        $getGenres = $getGenresModel->findAll();
        $minutes = floor($totalWatchDuration / 60);
        $seconds = ($totalWatchDuration % 60);
        $time = sprintf("%02d:%02d", $minutes, $seconds);
        return view('index',["songs"=>$getSongs,"genres"=>$getGenres,"time"=>$time]);
    }

    public function loadSavingPlaylist(){
        return view('save');
    }

    public function savePlaylist(){
        $userId = session()->get('id');

        $playlistModel = new getPlaylists();
        $playlistSongs = new getPlaylistSongs();
        $data = [
            'name'     => $this->request->getVar('name'),
            'userId'    => $userId,
        ];
        $playlistModel->save($data);
        $createdPlaylist = $playlistModel->orderby('id','DESC')->where("name" , $this->request->getVar('name'))->limit(1)->first();
        $queue = session()->get("queue");    
        foreach($queue as $playlistSong =>$songs){
            $songdata = [
                'songId' => $songs,
                'playlistId' => $createdPlaylist["id"]
            ];
            $playlistSongs->save($songdata);
        }

        session()->remove("queue");
        return redirect()->to('/home');
    }

    public function updatePlaylist($id){
        $playlistModel = new getPlaylists();
        $name =  $this->request->getVar('name');
        $data = [
            'id' => $id,
            'name'=> $name,
            'userId' => session()->get("id")
        ];
        $playlistModel->where("id",$id)->replace($data);
        return redirect()->back();
    }
    
    public function deleteSongPlaylist($songId){
        $getplaylistSongs = new getPlaylistSongs();
        $playlistSongs = $getplaylistSongs->where('id', $songId)->first();
        $getplaylistSongs->delete($playlistSongs);
        return redirect()->back();
    }
    public function addSongToPlaylist($songId){
        $getPlaylistSongsModel = new getPlaylistSongs();
        $playlistId =  $this->request->getVar('playlistId');
        $data = [
            'songId'=> $songId,
            'playlistId' => $playlistId
        ];
        $getPlaylistSongsModel->save($data);
        return redirect()->back();;
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