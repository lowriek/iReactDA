<?php
// set a reaction data set into the db

include 'dbconn.php';

	# Get JSON as a string
$reaction_str = file_get_contents('php://input');

$dbc = connectToDB();
$query = "SELECT compositionID FROM composition WHERE collectionenabled=true";
$result = performQuery($dbc, $query);
$num_rows = mysqli_num_rows($result);
if (($num_rows > 1) ) {
  echo "Error: There are too many collection sites enabled !?!";
  exit;
} else if ( $num_rows == 0 ) {
  echo "Error: There are no collection sites enabled !?!";
  exit;
}

// there is only one collection site enabled.  Get the number.
$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['compositionID'];

$query = "INSERT INTO reactiondata (compositionID, reaction) VALUES ($id, '$reaction_str')";
performQuery($dbc, $query);


//echo "Houston we have contact... " . $query . " olay!";
echo "Reactions saved!";
exit;
