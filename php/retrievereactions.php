<?php
// get all reaction data from the db

include 'dbconn.php';

$dbc = connectToDB();

// add check for collectionenabled?
$query = "SELECT reaction FROM reactiondata";
$result = performQuery($dbc, $query);
$reactions = array();
while ($row = mysqli_fetch_row($result))
    {
      $current_row = json_decode( $row[0] );
      $reactions = array_merge( $reactions, $current_row );
    }

// returns all data as one array
echo json_encode( $reactions );
exit;
?>
