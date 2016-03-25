<?php
require 'index.php';
?>


<div class="container">
    <h1>
        Teams
    </h1>


    <?php
    error_reporting(-1);
    ini_set('display_errors',1);
    
    $query = "SELECT * FROM TEAM";
    $res = oci_parse($conn,$query);


    if (oci_execute($res)){
        echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Team Name</th>";
        echo "<th>Inaugural Year</th>";
        echo"</thead>";
        while ($row = oci_fetch_array($res)){
            echo "<tr onclick=\"document.location = 'http://www.ugrad.cs.ubc.ca/~j7g0b/views/teamPage.php?".$row['TNAME']."'\"><td>";
            echo $row['TNAME']."</td><td>";
            echo $row['INAUGURALYEAR']."</td><td>";
            echo "</td></tr>\n";
        }
        echo "</table>";
    }
    ?>
</div>
</body>
</html>