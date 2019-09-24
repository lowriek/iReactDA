<?php

function displayEnabledCollection(){

	$dbc = connectToDB();
	$query = "select * from collection as coll join composition as comp where coll.compositionID=comp.compositionID and coll.collectionenabled=true
	";
	$result = performQuery($dbc, $query);
	$rowcount=mysqli_num_rows($result);

	if ( $rowcount > 1 ){
	  echo "Error: There are $rowcount collection sites enabled !?!";
	  exit;
	} else if ( $rowcount == 0 ){
		echo "Nocollection sites are currently enabled.";
	} else {
		$row=mysqli_fetch_array($result, MYSQLI_ASSOC);
		$description = $row['description'];
		$composer = $row['composername'];
		$compositionName = $row['compositionname'];

		echo "Collecting reactions for $compositionName by $composer - $description";
	}
}
?>
