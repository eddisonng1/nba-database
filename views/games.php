<?php
require 'index.php';

?>


<div class="container">
    <h1>Games
        <?php
        $parameter = $_SERVER['QUERY_STRING'];
        if ($parameter){
            echo " in ".$parameter;
        }
        else{
            echo " (All Time)";
        }
        ?>
    </h1>

    <input id="year" type="number" placeholder="Input Year (YYYY)"> <a class="btn btn-default" onclick="document.location = 'http://www.ugrad.cs.ubc.ca/~j7g0b/views/games.php?'+document.getElementById('year').value">Search</a>
    <?php
    error_reporting(-1);
    ini_set('display_errors',1);



    if(!$parameter){
        $parameter = "'%'";
    }
    $query = "SELECT * FROM GAME WHERE year LIKE ".$parameter;
    $res = oci_parse($conn,$query);

    if(isset($_POST['delete'])){
        $deleteQuery = "DELETE FROM GAME WHERE GAME.GAMEID =".$_POST['delete'];
        $res1 = oci_parse($conn,$deleteQuery);
        oci_execute($res1);
    }


    if (oci_execute($res)){
        echo "<table class=\"table table-hover\" style='width: 100%'>";
        echo "<thead>";
        echo "<th>Winner</th>";
        echo "<th>Loser</th>";
        echo "<th>Arena Name</th>";
        echo "<th>Winner Score</th>";
        echo "<th>Loser Score</th>";
        echo "<th>Game Date</th>";
        echo "<th>Year</th>";
        echo "<th>Delete</th>";
        echo"</thead>";
        while ($row = oci_fetch_array($res)){
            echo "<tr><td>";
            echo $row['WINNERTNAME']."</td><td>";
            echo $row['LOSERTNAME']."</td><td>";
            echo $row['ARENANAME']."</td><td>";
            echo $row['WINNERSCORE']."</td><td>";
            echo $row['LOSERSCORE']."</td><td>";

            echo $row['GAMEDATE']."</td><td>";
            echo $row['YEAR']."</td><td>";
            echo "<form method=\"post\">
                    <button class='btn btn-danger' name=\"delete\" type=\"submit\" value=\"".$row['GAMEID']."\" />Delete</button></form>";
            echo "</td></tr>\n";
        }
        echo "</table>";
    }
    ?>
</div>



</body>
</html>
