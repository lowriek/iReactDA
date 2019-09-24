<?php
// set a reaction data set into the db

include 'dbconn.php';

$dbc = connectToDB();
$query = "SELECT reaction FROM reactiondata";
$result = performQuery($dbc, $query);
  //print_r( $result );
$reactions = array();
while ($row = mysqli_fetch_row($result))
    {
      //print_r( $row );
      $current_row = json_decode( $row[0] );
      $reactions = array_merge( $reactions, $current_row );
    }

// returns all data as one array for a scatter chart
echo json_encode( $reactions );
exit;
