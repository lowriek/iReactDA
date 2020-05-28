<?php
// save a reaction data set into the db

include 'dbconn.php';

	# Get JSON as a string
$reaction_str = file_get_contents('php://input');
$reaction_name = $_GET['idstr'];
$collectionID = $_GET['collectionID'];

// KBL TODO - this is risky, maybe another way?
//$collection_id = $_GET['collectionID'];

$query = "INSERT INTO reactiondata (collectionID, reaction, reactionName) VALUES ($collectionID, '$reaction_str', '$reaction_name')";
$dbc = connectToDB();
performQuery($dbc, $query);


//echo "Houston we have contact... " . $query . " olay!";
echo "Reactions saved! $reaction_name";
exit;
