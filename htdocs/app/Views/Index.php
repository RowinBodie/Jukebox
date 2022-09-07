<?php
    $session = session()->get("queue");
    $getSongsModel = new \App\Models\getSongs;
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
        <div>
            <h1>Awesome Playlists</h1>
        </div>
        <nav>
            <ul id="nav-items">
                <li><a href="/">Homepage</a></li>
                <li><a href="/playlists">Playlists</a></li>
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
                <ul id="songs-list">
                    <?php foreach($songs as $count => $song){
                        ?><li><a href="/songDetail/<?php echo $song["id"] ?>"><?php echo $song["name"] ?></a> _ <a href="/addQueueSong/<?php echo $song["id"]?>">add to queue</a></li>
                    <?php }; ?>
                </ul>
            </div>
            <div id="queue">
                <h3>Queue_<a href="/clearQueueSong">Clear</a></h3>
                <ul id="queue-list">
                    <?php 
                    $hold = 0;
                    foreach($session as $queue => $sessionSong){
                        $getSongForQueue = $getSongsModel->where("id", $sessionSong)->first();
                    ?>
                        <li><?php echo $getSongForQueue['name'] ?>_<a href="/removeQueueSong/<?php echo $hold?>">remove</a></li>
                    <?php 
                    $hold+=1;
                    }; 
                    ?>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>
