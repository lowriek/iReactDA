<?php
// set a reaction data set into the db

include 'dbconn.php';

	# Get JSON as a string
$reaction_str = file_get_contents('php://input');

$dbc = connectToDB();
$query = "INSERT INTO reactiondata (compositionID, reaction) VALUES (1, '$reaction_str')";
performQuery($dbc, $query);


echo "Houston we have contact... " . $query . " olay!";
exit;
