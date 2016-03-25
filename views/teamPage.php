<?php
require 'index.php';
?>

<div class="container">
    <h1>Team :
        <?php
        $parameter = $_SERVER['QUERY_STRING'];
        $parameter = str_replace("%20"," ",$parameter);
        echo $parameter;
        ?>
    </h1>

    <?php
    $query = "SELECT * FROM TEAM WHERE TEAM.TNAME = '".$parameter."'";
    $res = oci_parse($conn,$query);

    if (oci_execute($res)){
        echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Team Name</th>";
        echo "<th>InAugural Year</th>";
        echo"</thead>";
        while ($row = oci_fetch_array($res)){
            echo "<tr><td>";
            echo $row['TNAME']."</td><td>";
            echo $row['INAUGURALYEAR']."</td><td>";
            echo "</td></tr>\n";
        }
        echo "</table>";
    }
    ?>

    <h3>Games Played Per Season</h3>

    <?php
    $aggregationQuery = "SELECT YEAR, COUNT(*) AS GAMESPLAYED FROM GAME WHERE WINNERTNAME = '".$parameter."' OR LOSERTNAME = '".$parameter."' GROUP BY YEAR";
    $res = oci_parse($conn,$aggregationQuery);

    if (oci_execute($res)){
        echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Year</th>";
        echo "<th># Of Games</th>";
        echo"</thead>";
        while ($rowAgg = oci_fetch_array($res)){
            echo "<tr><td>";
            echo $rowAgg['YEAR']."</td><td>";
            echo $rowAgg['GAMESPLAYED']."</td><td>";
            echo "</td></tr>\n";
        }
        echo "</table>";
    }
    ?>


</div>
</body>
</html>

