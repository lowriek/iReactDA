<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>testing a form!</title>
	<!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	 <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
<?php

die('got to foo');

echo "<pre>";
	print_r($_GET[]);
echo "</pre>";



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

</body>
</html>
