<?php
die('got to insertComposition');
$user = 'root';
$password = 'root';
$db = 'ireact';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
if (!$con)
  {
  die("mysqli_init failed");
  }
  mysqli_query($con,"INSERT INTO compositions (ComposerName,CompositionName)
  VALUES ('$_POST[]','Quagmire',33)");
$success = mysqli_real_connect(
   $link,
   $host,
   $user,
   $password,
   $db,
   $port
);

?>

<?
function connectToDB(){
	$dbc = @mysqli_connect("localhost", "root", "root", "wfb2007")
			OR die("Connect failed: ".mysqli_connect_error());
	return $dbc;
}
function disconnectFromDB($dbc, $result){
	mysqli_free_result($result);
	mysqli_close($dbc);
}
function performQuery($dbc, $query){
	//echo "query is $query";
	$result = mysqli_query($dbc, $query) or die("bad query".mysqli_error($dbc));
	return($result);
}
?>
