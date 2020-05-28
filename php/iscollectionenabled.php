<?php

include 'dbconn.php';
header("content-type:application/json");
	# Get JSON as a string
//$reaction_str = file_get_contents('php://input');

$dbc = connectToDB();
$query = "select * from collection as coll join composition as comp where coll.compositionID=comp.compositionID and coll.collectionenabled=true
";
$result = performQuery($dbc, $query);
$rowcount = mysqli_num_rows($result);



echo "There are $rowcount collection sites enabled";

w$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
$description = $row['description'];
$composer = $row['composername'];
$compositionName = $row['compositionname'];

echo "$compositionName by $composer $description";

exit;
