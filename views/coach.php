<?php
require 'index.php';
?>

<div class="container">
    <h1>Coach</h1>
    <?php
    

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


