<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Song Details</title>
    <link rel="stylesheet" href="/css/index.css">
</head>
<body>
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
    <div class="song">
        <div id="songs">
            <h3>Songs</h3>
            <ul id="songs-list">
                <?php foreach($songs as $count => $song){?>
                    <li>song name: <?php echo $song["name"] ?></li>
                    <li>artist: <?php echo $song["artist"] ?></li>
                    <li>song duration in seconds: <?php echo $song["duration"] ?></li>
                    <li>song lyrics: <?php echo $song["lyrics"] ?></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</body>
</body>
</html>