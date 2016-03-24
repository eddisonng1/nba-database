<?php
require 'index.php';
?>


<div class="container">
    <h1>Seasons</h1>
<?php
error_reporting(-1);
ini_set('display_errors',1);

$query = "SELECT * FROM SEASON";
$res = oci_parse($conn,$query);

if (oci_execute($res)){
    echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Year</th>";
        echo "<th>Start Date</th>";
        echo "<th>End Date</th>";
        echo"</thead>";
    while ($row = oci_fetch_array($res)){
        echo "<tr onclick=\"document.location = 'http://www.ugrad.cs.ubc.ca/~j7g0b/views/games.php?".$row['YEAR']."'\"><td>";
        echo $row['YEAR']."</td><td>";
        echo $row['STARTDATE']."</td><td>";
        echo $row['ENDDATE']."</td><td>";
        echo "</td></tr>\n";
    }
    echo "</table>";
}
?>
</div>
</body>
</html>


