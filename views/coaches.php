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
    $conn = OCILogon("ora_j7g0b", "a37945136", "ug");
    $query = "SELECT * FROM COACHES WHERE COACHID LIKE ".$parameter;
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


