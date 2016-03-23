<!DOCTYPE html>
<html>
<?php

    $conn = OCILogon("ora_j7g0b", "a37945136", "ug");
    if (!conn) {
        $m = oci_error();
        exit ('Connection error' . $m[message]);
    }

    $query = "SELECT * FROM player";
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

?>

</html>
