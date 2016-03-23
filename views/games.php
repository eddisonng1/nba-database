<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>    <title>NBASTATS: FOR ALL YOUR NBA NEEDS</title>

</head>

<body>

<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="#">NBASTATS</a>
        </div>
        <ul class="nav navbar-nav">
            <li><a href="#">Home </a></li>
            <li><a href="#">Players</a></li>
            <li><a href="coach.php">Coach</a></li>
            <li><a href="#">Teams</a></li>
            <li><a href="season.php">Seasons</a></li>
            <li><a href="games.php">Games</a></li>
        </ul>
    </div>
</nav>

<div style="height: 100px;"></div>

<div class="container">
    <h1>Games
        <?php
        $parameter = $_SERVER['QUERY_STRING'];
        if ($parameter){
            echo " in ".$parameter;
        }
        else{
            echo " (All Time)";
        }
        ?>
    </h1>

    <input id="year" type="number" placeholder="Input Year (YYYY)"> <a class="btn btn-default" onclick="document.location = 'http://www.ugrad.cs.ubc.ca/~j7g0b/views/games.php?'+document.getElementById('year').value">Search</a>
    <?php
    error_reporting(-1);
    ini_set('display_errors',1);



    if(!$parameter){
        $parameter = "'%'";
    }

    $conn = OCILogon("ora_j7g0b", "a37945136", "ug");
    $query = "SELECT * FROM GAME WHERE year LIKE ".$parameter;
    $res = oci_parse($conn,$query);


    if (oci_execute($res)){
        echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Winner</th>";
        echo "<th>Loser</th>";
        echo "<th>Arena Name</th>";
        echo "<th>Winner Score</th>";
        echo "<th>Loser Score</th>";
        echo "<th>Game Date</th>";
        echo "<th>Year</th>";
        echo"</thead>";
        while ($row = oci_fetch_array($res)){
            echo "<tr><td>";
            echo $row['WINNERTNAME']."</td><td>";
            echo $row['LOSERTNAME']."</td><td>";
            echo $row['ARENANAME']."</td><td>";
            echo $row['WINNERSCORE']."</td><td>";
            echo $row['LOSERSCORE']."</td><td>";
            echo $row['GAMEDATE']."</td><td>";
            echo $row['YEAR']."</td><td>";
            echo "</td></tr>\n";
        }
        echo "</table>";
    }
    ?>
</div>
</body>
</html>
