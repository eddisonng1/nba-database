<?php
require 'index.php';
?>

<div class="container">
    <h1>Teams Coached By:
        <?php
        $parameter = $_SERVER['QUERY_STRING'];

        if ($parameter){

            $conn = OCILogon("ora_j7g0b", "a37945136", "ug");
            $coachQuery = "SELECT * FROM COACH WHERE COACHID =".$parameter;
            $resCoach = oci_parse($conn,$coachQuery);

            if (oci_execute($resCoach)){
                while ($row = oci_fetch_array($resCoach)){
                    $coach = $row['LNAME'].", ".$row['FNAME'];
                }
            }
            echo $coach;

        }
        else{
            echo " (All)";
            $parameter = "'%'";
        }

        ?>
    </h1>

    <?php
    $query = "SELECT * FROM COACHES, COACH WHERE COACHES.COACHID = COACH.COACHID AND COACH.COACHID LIKE ".$parameter;
    $res = oci_parse($conn,$query);

    if (oci_execute($res)){
        echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Coach ID</th>";
        echo "<th>Team Name</th>";
        echo "<th>From</th>";
        echo "<th>To</th>";
        echo "<th>Salary</th>";
        echo"</thead>";
        while ($row = oci_fetch_array($res)){
            echo "<tr><td>";
            echo $coach."</td><td>";
            echo $row['TEAMNAME']."</td><td>";
            echo $row['FROMDATE']."</td><td>";
            echo $row['TODATE']."</td><td>";
            echo $row['SALARY']."</td><td>";
            echo "</td></tr>\n";
        }
        echo "</table>";
    }
    ?>
</div>
</body>
</html>


