<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>saving playlist</title>
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
        <div>
        <p>wanneer je een playlist aanmaak wordt je queue leeg gemaakt.</p>
        <form action="<?php echo base_url(); ?>/Home/savePlaylist" method="post">
            <div class="form-group mb-3">
                <input type="text" name="name" placeholder="name of playlist">
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-success">create playlist</button>
            </div>
        </form>
        </div>
    </div>
</body>
</html>