<?php

function connectToDB(){
  $user = 'root';
  $password = 'root';
  $db = 'ireact';
  $host = 'localhost';
  $port = 8889;

  $link = mysqli_init();
  $success = mysqli_real_connect(
     $link,
     $host,
     $user,
     $password,
     $db,
     $port
  );

	if (! $success) {
    die("Connect failed: ".mysqli_connect_error());
  }
	return $link;
}
function disconnectFromDB($dbc, $result){
	mysqli_free_result($result);
	mysqli_close($dbc);
}
function performQuery($dbc, $query){
	//echo "query is $query";
	$result = mysqli_query($dbc, $query) or die("bad query >$query<".mysqli_error($dbc));
	return $result;
}
?>
