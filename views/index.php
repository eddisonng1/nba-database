
<head>
    <meta charset="UTF-8">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>

    <title>NBASTATS: FOR ALL YOUR NBA NEEDS</title>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">NBASTATS</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#">Home </a></li>
            <li><a href="players.php">Players</a></li>
            <li><a href="coach.php">Coaches</a></li>
            <li><a href="teams.php">Teams</a></li>
            <li><a href="season.php">Seasons</a></li>
            <li><a href="games.php">Games</a></li>
        </ul>
    </div>
</nav>

<?php
error_reporting(-1);
ini_set('display_errors',1);

$conn = OCILogon("ora_j7g0b", "a37945136", "ug");
?>
?>

<br>
<br>
