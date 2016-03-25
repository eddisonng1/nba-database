<!DOCTYPE html>
<html>
<?php

function getAllPlayers($conn){
    $query = "SELECT * FROM player";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);
    return $stid;
}


function getIndividualPlayer($conn, $playerID){
    $query = "SELECT * FROM player WHERE PLAYERID = $playerID";
    $stid = oci_parse($conn, $query);

    oci_define_by_name($stid, 'PLAYERID', $ID);
    oci_define_by_name($stid, 'FNAME', $fname);
    oci_define_by_name($stid, 'LNAME', $lname);
    
    oci_execute($stid);
    return $stid;
}

function getStatsbyYear($conn, $playerID) {
    $query =
        "SELECT g.YEAR, AVG(s.POINTS) AS POINTS, AVG(s.REBOUNDS) AS REBOUNDS, AVG(s.STEALS) AS STEALS, AVG(s.FGPERCENT) AS FGPERCENT, AVG(s.TURNOVER) AS TURNOVERS, AVG(s.MINUTESPLAYED) AS MINUTESPLAYED
        FROM PLAYER p, PERFORMED s, GAME g
        WHERE p.PLAYERID = $playerID AND p.PLAYERID = s.PLAYERID AND s.GAMEID = g.GAMEID
        GROUP BY g.YEAR";

    $stid = oci_parse($conn, $query);

    oci_execute($stid);
    return $stid;
}

?>

</html>
