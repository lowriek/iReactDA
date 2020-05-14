<?php
// save a reaction data set into the db

include 'dbconn.php';

	# Get JSON as a string
$reaction_str = file_get_contents('php://input');
$reaction_name = $_GET['idstr'];

$dbc = connectToDB();
$query = "SELECT collectionID FROM collection WHERE collectionenabled=true";
$result = performQuery($dbc, $query);
$num_rows = mysqli_num_rows($result);
if (($num_rows > 1) ) {
  echo "Error: There are too many collection sites enabled !?! $reaction_name";
  exit;
} else if ( $num_rows == 0 ) {
  echo "Error: There are no collection sites enabled !?! $reaction_name";
  exit;
}

// there is only one collection site enabled.  Get the number.
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['collectionID'];


$query = "INSERT INTO reactiondata (collectionID, reaction, reactionName) VALUES ($id, '$reaction_str', '$reaction_name')";
performQuery($dbc, $query);


//echo "Houston we have contact... " . $query . " olay!";
echo "Reactions saved! $reaction_name";
exit;
