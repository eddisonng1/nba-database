
<?php
require 'index.php';
?>

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

$stid = getAllPlayers($conn);

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
</div>
</body>
</html>

<?php
