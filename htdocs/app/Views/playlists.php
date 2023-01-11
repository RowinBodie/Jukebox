<?php
    $getSongsModel = new \App\Models\getSongs;
    $getPlaylistSongsModel = new \App\Models\getPlaylistSongs;
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Playlists</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
    <div>
        <div>
            <h1>Awesome Playlists</h1>
        </div>
        <nav>
            <ul id="nav-items">
                <li><a href="/home">Homepage</a></li>
                <li><a href="/playlists">Playlists</a></li>
            </ul>
        </nav>
        <div>
            <?php
            foreach($playlists as $number => $playlist){
                $songs = $getPlaylistSongsModel->where("playlistid", $playlist["id"])->findall();
            ?>
            <form action="<?php echo base_url(); ?>/Home/updatePlaylist/<?php echo $playlist["id"]?>" method="post">
            <div class="form-group mb-3">
                <input type="text" name="name" value="<?=$playlist["name"]?>">
            </div>
        </form>
            <ul>
                <?php
                    foreach($songs as $number =>$songid){
                        $song = $getSongsModel->where("id", $songid["songId"])->first();
                ?>
                <li><?= $song["name"]?> <a href="/deleteSongPlaylist/<?=  $songid["id"]?>">remove</a></li>
                <?php
                    };
                ?>
            </ul>
            <?php
                }
            ?>
        </div>
    </div>
</body>
</html>
