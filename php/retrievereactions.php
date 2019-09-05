<?php
// set a reaction data set into the db

include 'dbconn.php';

$dbc = connectToDB();
$query = "SELECT reaction FROM reactiondata";
$result = performQuery($dbc, $query);
$reactions = "";
while ($row = mysqli_fetch_row($result))
    {
    $reactions .= $row[0];
    }

echo $reactions;
exit;
?>
