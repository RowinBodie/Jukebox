<?php
    $getSongsModel = new \App\Models\getSongs;
    $getPlaylistsModel = new \App\Models\getPlaylists;
    $getQueueSessionController = new \App\Controllers\QueueSessionController;
    
    // session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    <div>
        <div class="line">
            <h1>Awesome Playlists</h1>
            <?php
            if(isset($_SESSION['isLoggedIn'])){
            ?>
            <p> welcome <?php echo $_SESSION['name'] ?></p>
            <a href="/logout"><button>Logout</button></a>
            <?php
                }
                else{
            ?>
            <a href="/signin"><button>SignIn</button></a>
            <a href="/signup"><button>SignUp</button></a>
            <?php
                }
            ?>
        </div>
        <nav>
            <ul id="nav-items">
                <li><a href="/home">Homepage</a></li>
                <?php
            if(isset($_SESSION['isLoggedIn'])){
            ?>
                <li><a href="/playlists">Playlists</a></li>
            <?php
            }
            ?>
            </ul>
        </nav>
        <div id="lists-body">
            <div id="genres">
                <h3>Genres</h3>
                <ul id="genres-list">
                    <?php foreach($genres as $count => $genre){
                        ?><li><a href="/genres/<?php echo $genre["id"]?>"><?php echo $genre["name"] ?></a></li>
                    <?php }; ?>
                </ul>
            </div>
            <div id="songs">
                <h3>Songs</h3>
                <ul id="holder">
                    <li>name</li>
                    :
                    <li>song_duration</li>
                    :
                    <li>artist</li>
                </ul>
                <ul id="songs-list">
                    <?php foreach($songs as $count => $song){
                        ?><li>
                            <a href="/songDetail/<?php echo $song["id"] ?>"><?php echo $song["name"] ?></a>
                            %
                            <p class="inline"><?= $song["duration"]?></p>
                            %
                            <p class="inline"><?= $song["artist"]?></p>
                            %
                            <a href="/addQueueSong/<?php echo $song["id"]?>">add to queue</a>                            
                            <?php
                            if(isset($_SESSION['isLoggedIn'])){
                            ?>
                            %
                                <form action="<?php echo base_url(); ?>/Home/addSongToPlaylist/<?php echo $song["id"]?>" method="post">
                                <select id="playlistId" name="playlistId">
                                    <?php
                                    $playlists = $getPlaylistsModel->where("userId", session()->get("id"))->findall();
                                    foreach($playlists as $i => $playlist){
                                    ?>
                                    <option value="<?= $playlist['id']?>"><?= $playlist['name']?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                                <input type="submit">
                                </form>
                            <?php
                            }
                            ?>
                        </li>
                    <?php }; ?>
                </ul>
            </div>
            <div id="queue">
                <h3>Queue <?php if(isset($_SESSION['name'])){ ?> <a href="/savePlaylist">Save</a> <?php } ?> <a href="/clearQueueSong">Clear</a></h3>
                <ul id="queue-list">
                    <li>Total duration: <?php 
                        if(isset($_SESSION['queue']) ){
                            echo $time;
                        }                    
                    ?></li>
                    <?php
                    foreach($getQueueSessionController->getSession() as $queue => $sessionSong){
                        $getSongForQueue = $getSongsModel->where("id", $sessionSong)->first();
                    ?>
                        <li><?php echo $getSongForQueue['name'] ?>_<a href="/removeQueueSong/<?php echo $queue?>">remove</a></li>
                    <?php }; ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>

