<?php
include 'php/dbconn.php';

function displayEnabledCollection(){

	$dbc = connectToDB();
	$query = "SELECT * FROM collection AS coll JOIN composition AS comp
							WHERE coll.compositionID=comp.compositionID
							AND coll.collectionenabled=true";

	$result = performQuery($dbc, $query);
	$rowcount=mysqli_num_rows($result);

  if ( $rowcount == 0 ){
		echo "No collection sites are currently enabled.";
	} else if ( $rowcount == 1 ) {
		$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
		$description = $row['description'];
		$composer = $row['composername'];
		$compositionName = $row['compositionname'];
		echo "Collecting reactions for $compositionName by $composer - $description";
	} else {
		echo "Error: There are $rowcount collection sites enabled !?!";
	}
}

function createCollection( $compositionID, $description ){
		$dbc = connectToDB();
		$query = "INSERT INTO collection (compositionID, description) VALUES ('$compositionID', '$description');";
		performQuery($dbc, $query);}

function enableCollection( $id ){
	$query = "UPDATE collection SET collectionenabled = true WHERE collectionID = $id";
	//die( $query);
	$dbc = connectToDB();
	performQuery($dbc, $query);
}

function disablecollection($id){
	$query = "UPDATE collection SET collectionenabled = false WHERE collectionID = $id";
	//die( $query);

	$dbc = connectToDB();
	$result = performQuery($dbc, $query);
}

function createComposition($composerName, $compositionName){
	$dbc = connectToDB();
	$query = "INSERT INTO composition (composername, compositionname) VALUES ('$composerName', '$compositionName');";
	performQuery($dbc, $query);
}

function getCompositionOptions(){
	$dbc = connectToDB();
	$query = "SELECT compositionID, compositionname from composition";
	$result = performQuery($dbc, $query);
	$options = "";

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$id = $row['compositionID'];
		$name = $row['compositionname'];

		if (isset($_POST['thiscomposition']) && ($_POST['thiscomposition']==$id))
			$options .= "<option value = \"$id\" selected>$name</option>\n";
		else
			$options .= "<option value = \"$id\">$name</option>\n";
	}
	disconnectFromDB($dbc, $result);
	return $options;
}

function getCollectionOptions(){
	$dbc = connectToDB();
	$query = "SELECT collectionID, description from collection";
	$result = performQuery($dbc, $query);
	$options = "";

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$id = $row['collectionID'];
		$name = $row['description'];

		if (isset($_POST['thiscollection']) && ($_POST['thiscollection']==$id))
			$options .= "<option value = \"$id\" selected>$name</option>\n";
		else
			$options .= "<option value = \"$id\">$name</option>\n";
	}
	disconnectFromDB($dbc, $result);
	return $options;
}
