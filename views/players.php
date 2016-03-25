<?php
require 'index.php';
?>

<body>
<div class="container">
    <h2>PLAYERS</h2>

    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
    <tr>
        <th> Height </th>
        <th> Weight </th>
        <th> Number </th>
        <th> Fname </th>
        <th> Lname </th>
        <th> Position </th>
        <th> Update </th>
    </tr>
            </thead>
            <tbody>



<?php
include "../data/player.php";
$stid = getAllPlayers($conn);

while ($row = oci_fetch_array($stid)){

    $playerID = $row['PLAYERID'];
    $playerName = $row['FNAME'] .  $row['LNAME'];

    echo "<tr onclick=\"document.location = 'http://www.ugrad.cs.ubc.ca/~j7g0b/views/playerPage.php?".$playerID."'\">";
    echo "<td>" . htmlentities($row['HEIGHT']) . "</td>";
    echo "<td>" . htmlentities($row['WEIGHT']) . "</td>";
    echo "<td>" . htmlentities($row['NUMBERONBACK']) . "</td>";
    echo "<td>" . htmlentities($row['FNAME']) . "</td>";
    echo "<td>" . htmlentities($row['LNAME']) . "</td>";
    echo "<td>" . htmlentities($row['POSITION']) . "</td>";
    echo "<td><form method=\"post\">
                    <button class='btn btn-warning' name=\"update\" type=\"submit\" value=\"".$row['PLAYERID']."\" />Update</button></form>";
    echo "</td></tr>";

 }

oci_free_statement($stid);
?>
            </tbody>
            </table>

        <?php

        if(isset($_POST['update'])){
            echo "<h2>Update Player</h2>
<div class=\"table-responsive\">
<table class='table table-hover' >
<thead>
<tr>
    <td>Height</td>
    <td>Weight</td>
    <td>Number</td>
    <td>FName</td>
    <td>LName</td>
    <td>Position</td>
    <td>Update</td>
</tr>
</thead>
<tbody>
<tr>
    <td><input class='form-control' type='text'></td>
    <td><input class='form-control' type='text'></td>
    <td><input class='form-control' type='text'></td>
    <td><input class='form-control' type='text'></td>
    <td><input class='form-control' type='text'></td>
    <td><input class='form-control' type='text'></td>
    <td><button class='btn btn-success'>Update</button></td>
</tr>
</tbody>    
</table>
</div>

";

        }

        ?>
        </div>
</body>
</html>

<?php
