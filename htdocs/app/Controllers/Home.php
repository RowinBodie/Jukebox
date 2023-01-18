<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Models\getPlaylists;
use App\Models\getPlaylistSongs;
use \App\Controllers\QueueSessionController;

class Home extends BaseController
{
    // general page loading function
    public function loadGeneralPage(){
        // gets the models
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $getQueueSessionController = new \App\Controllers\QueueSessionController;
        // gets all data needed
        $getSongs = $getSongsModel->findAll();
        $getGenres = $getGenresModel->findAll();
        // base time variables
        $totalWatchDuration = 0;
        $time = "00:00";
        if($getQueueSessionController->isSet()){
            // generates the total duration for the queue
            foreach($getQueueSessionController->getSession() as $session => $sessionSong){
                $getSongForQueue = $getSongsModel->where("id", $sessionSong)->first();
                $totalWatchDuration += $getSongForQueue["duration"];
            }
            $minutes = floor($totalWatchDuration / 60);
            $seconds = ($totalWatchDuration % 60);
            $time = sprintf("%02d:%02d", $minutes, $seconds);

            return view('index',["songs"=>$getSongs,"genres"=>$getGenres,"time"=>$time]);
        }else{
            $getQueueSessionController->createSession();
            return view('index',["songs"=>$getSongs,"genres"=>$getGenres,"time"=>$time]);
        }        
    }
    // load the genre page
    public function loadGenre($id){
        // get models
        $getSongsModel = new \App\Models\getSongs;
        $getGenresModel = new \App\Models\getGenres;
        $getQueueSessionController = new \App\Controllers\QueueSessionController;
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
        $getQueueSessionController = new \App\Controllers\QueueSessionController;
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
        $queue = $getQueueSessionController->getSession();  
        // save everthing into the newly created playlist 
        foreach($queue as $playlistSong =>$songs){
            $songdata = [
                'songId' => $songs,
                'playlistId' => $createdPlaylist["id"]
            ];
            $playlistSongs->save($songdata);
        }

        $getQueueSessionController->emptySession();
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
        $getQueueSessionController = new \App\Controllers\QueueSessionController;
        $getQueueSessionController->addSong($id);
        return redirect()->back();
    }
    // clear the queue
    public function clearQueueSong(){
        $getQueueSessionController = new \App\Controllers\QueueSessionController;
        $getQueueSessionController->emptySession();
        return redirect()->back();
    }
    // remove song from queue
    public function removeQueueSong($id){
        $getQueueSessionController = new \App\Controllers\QueueSessionController;
        $queue = $getQueueSessionController->getSession();
        foreach($queue as $position=>$item){
            if($position == $id){
                unset($queue[$position]);
            }
        }
        $getQueueSessionController->setData($queue);
        return redirect()->back();
    }
}