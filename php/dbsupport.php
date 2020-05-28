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

function displayEnabledCollectionCount(){

	$dbc = connectToDB();
	$query = "SELECT * FROM collection AS coll JOIN composition AS comp
							WHERE coll.compositionID=comp.compositionID
							AND coll.collectionenabled=true";

	$result = performQuery($dbc, $query);
	$rowcount=mysqli_num_rows($result);

	echo "There are $rowcount collection sites enabled.";

}

function createCollection( $compositionID, $description ){
		$dbc = connectToDB();
		$query = "INSERT INTO collection (compositionID, description) VALUES ('$compositionID', '$description');";
		performQuery($dbc, $query);
}

function enableCollection( $id ){
	$query = "UPDATE collection SET collectionenabled = true WHERE collectionID = $id";
	//die( $query);
	$dbc = connectToDB();
	performQuery($dbc, $query);
}

function disableCollection($id){
	$query = "UPDATE collection SET collectionenabled = false WHERE collectionID = $id";
	//die( $query);

	$dbc = connectToDB();
	$result = performQuery($dbc, $query);
	if (!$result){
		die ($query);
	}
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

function getCollectionOptions($ccollection){
	$dbc = connectToDB();
	$query = "SELECT collectionID, compositionname, composername, url from collection as coll join composition as comp
	on coll.compositionID=comp.compositionID";
	$result = performQuery($dbc, $query);
	$options = "";

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$id = $row['collectionID'];
		$composition = $row['compositionname'];
		$composername = $row['composername'];

		if (isset($ccollection) && ($ccollection == $id))
			$options .= "<option value = \"$id\" selected>$composition by $composername</option>\n";
		else
			$options .= "<option value = \"$id\">$composition by $composername</option>\n";
	}
	disconnectFromDB($dbc, $result);
	return $options;
}

function getVideoURLOptions(){
	$dbc = connectToDB();
	$query = "SELECT collectionID, compositionname, url from collection as coll join composition as comp on coll.compositionID=comp.compositionID
										where coll.type='video' and coll.collectionenabled=1";

	$result = performQuery($dbc, $query);
	if (false == $result ){
		die($query);
	}

	$options = "";

	while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
		$id = $row['collectionID'];
		$name = $row['compositionname'];
		$url = $row['url'];

		if (isset($_POST['collectionID']) && ($_POST['collectionID']==$id))
			$options .= "<option value = \"$id\" selected>$name - $url</option>\n";
		else
			$options .= "<option value = \"$id\">$name - $url</option>\n";
	}
	disconnectFromDB($dbc, $result);
	return $options;
}

function showCurrentCollectionInfo($id){
	$dbc = connectToDB();
	$query = "SELECT * from collection where collectionID='$id'";

	$result = performQuery($dbc, $query);
	if (false == $result ){
		die($query);
	}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$url = $row['url'];
	$id = $row['collectionID'];
	echo "Collection ID $id collecting from $url";
}

function getCurrentCollectionInfoByCollectionID($id){
	$dbc = connectToDB();
	$query = "SELECT composername, compositionname, url from collection as col join composition as com
	      on col.compositionID = com.compositionID where collectionID='$id'";

	$result = performQuery($dbc, $query);
	if (false == $result ){
		die($query);
	}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$url = $row['url'];
	$composition = $row['compositionname'];
	$composer = $row['composername'];

	return "Collecting reaction to $composition by $composer";
}

function getURLbyCollectionID($id){
	$dbc = connectToDB();
	$query = "SELECT url from collection where collectionID=$id";

	$result = performQuery($dbc, $query);
	if (false == $result ){
		die($query);
	}
	$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
	$url = $row['url'];

	return $url;
}
