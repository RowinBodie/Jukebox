<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\getPlaylists;
use App\Models\getPlaylistSongs;

class Home extends BaseController
{
    // general page loading function
    public function loadGeneralPage(){
        // gets the models
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        // gets all data needed
        $getSongs = $getSongsModel->findAll();
        $getGenres = $getGenresModel->findAll();
        // base time variables
        $totalWatchDuration = 0;
        $time = "00:00";
        if(isset($_SESSION['queue']) ){
            // generates the total duration for the queue
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
    // load the genre page
    public function loadGenre($id){
        // get models
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $totalWatchDuration = 0;
        // gets data needed
        $getSongs = $getSongsModel->where("genre", $id)
                                    ->findAll();
        $getGenres = $getGenresModel->findAll();
        // calcs the total queue duration
        $minutes = floor($totalWatchDuration / 60);
        $seconds = ($totalWatchDuration % 60);
        $time = sprintf("%02d:%02d", $minutes, $seconds);
        return view('index',["songs"=>$getSongs,"genres"=>$getGenres,"time"=>$time]);
    }
    // saving a playlist redirection
    public function loadSavingPlaylist(){
        return view('save');
    }
    // save the queue to a playlist function
    public function savePlaylist(){
        // get userid from session
        $userId = session()->get('id');
        // get models
        $playlistModel = new getPlaylists();
        $playlistSongs = new getPlaylistSongs();
        // get data for database
        $data = [
            'name'     => $this->request->getVar('name'),
            'userId'    => $userId,
        ];
        // save to database
        $playlistModel->save($data);
        // get the lastest added database to add songs to
        $createdPlaylist = $playlistModel->orderby('id','DESC')->where("name" , $this->request->getVar('name'))->limit(1)->first();
        // get all songs from queue
        $queue = session()->get("queue");   
        // save everthing into the newly created playlist 
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
    // update playlist name function
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
    // delete song form playlist
    public function deleteSongPlaylist($songId){
        $getplaylistSongs = new getPlaylistSongs();
        $playlistSongs = $getplaylistSongs->where('id', $songId)->first();
        $getplaylistSongs->delete($playlistSongs);
        return redirect()->back();
    }
    // addsong from the homepage or genre page to a playlist
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
    // add song to queue
    public function addQueueSong($id){
        session()->push("queue", [$id]);
        return redirect()->back();
    }
    // clear the queue
    public function clearQueueSong(){
        session()->remove("queue");
        return redirect()->back();
    }
    // remove song from queue
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