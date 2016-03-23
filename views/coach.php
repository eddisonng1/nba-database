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
            <li><a href="#">Home</a></li>
            <li><a href="#">Players</a></li>
            <li><a href="coach.php">Coach</a></li>
            <li><a href="#">Teams</a></li>
            <li><a href="season.php">Seasons</a></li>
        </ul>
    </div>
</nav>

<div style="height: 100px;"></div>

<div class="container">
    <h1>Coach</h1>
    <?php
    error_reporting(-1);
    ini_set('display_errors',1);


    $conn = OCILogon("ora_j7g0b", "a37945136", "ug");
    $query = "SELECT * FROM COACH";
    $res = oci_parse($conn,$query);

    if (oci_execute($res)){
        echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Last Name</th>";
        echo "<th>First Name</th>";
        echo"</thead>";
        while ($row = oci_fetch_array($res)){
            echo "<tr onclick=\"document.location = 'http://www.ugrad.cs.ubc.ca/~j7g0b/views/coaches.php?".$row['COACHID']."'\"><td>";
            echo $row['LNAME']."</td><td>";
            echo $row['FNAME']."</td><td>";
            echo "</td></tr>\n";
        }
        echo "</table>";
    }
    ?>
</div>
</body>
</html>


