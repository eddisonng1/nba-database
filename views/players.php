<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>

    <title>NBASTATS: FOR ALL YOUR NBA NEEDS</title>

    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">NBASTATS</a>
            </div>
            <ul class="nav navbar-nav">
                <li><a href="#">Home </a></li>
                <li><a href="#">Players</a></li>
                <li><a href="#">Coaches</a></li>
                <li><a href="#">Teams</a></li>
                <li><a href="#">Seasons</a></li>
            </ul>
        </div>
    </nav>

</head>

<body>
<div class="container">
    <h2>PLAYERS</h2>

    <div class="table-responsive">
        <table class="table">
            <thead>
    <tr>
        <th> id </th>
        <th> Height </th>
        <th> Weight </th>
        <th> Number </th>
        <th> Fname </th>
        <th> Lname </th>
        <th> Position </th>
    </tr>
            </thead>
            <tbody>



<?php
include "../data/player.php";

while ($row = oci_fetch_array($stid)){
    echo "<tr><td>" . htmlentities ($row['PLAYERID']) . "</td>";
    echo "<td>" . htmlentities($row['HEIGHT']) . "</td>";
    echo "<td>" . htmlentities($row['WEIGHT']) . "</td>";
    echo "<td>" . htmlentities($row['NUMBERONBACK']) . "</td>";
    echo "<td>" . htmlentities($row['FNAME']) . "</td>";
    echo "<td>" . htmlentities($row['LNAME']) . "</td>";
    echo "<td>" . htmlentities($row['POSITION']) . "</td></tr>";

 }

oci_free_statement($stid);
?>

            </tbody>
            </table>
        </div>
</body>
</html>

<?php
