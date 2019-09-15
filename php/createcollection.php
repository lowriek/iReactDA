<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Create Collection Point</title>
	<!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	 <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
	<pre>
		<?php //print_r( $_POST ); ?>
	</pre>
	<?php
	include 'dbconn.php';

	if(isset($_POST['createcollection'])) {
		handleCollectionForm();
	}
	else if (isset($_POST['enablecollection'])){
		handleEnableCollectionForm();
	}
	else if (isset($_POST['disablecollection'])){
		handleDisableCollectionForm();
	}
	?>

	<div class="jumbotron" id="collectreaction">
		<h1 class="display-4">Create Collection Site</h1>
		<?php
			displayCollectionForm();
		?>
	</div>

	<div class="jumbotron" id="reactionsite">
		<h1 class="display-4">Enable/Disable Collection</h1>
		<?php
			displayEnableForm();
		?>
	</div>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="js/reaction.js"></script>

</body>
</html>
<?php
function displayEnableForm(){ // should only allow one compostion to collect...
?>
<form action="" method="post">
	<?php createSelect(); ?>
		<div class="form-group row">
			<button type="submit" class="btn btn-primary" name="enablecollection" value="1">Enable Reaction Collection</button>
		</div>
		<div class="form-group row">
			<button type="submit" class="btn btn-primary" name="disablecollection" value="1">Disable Reaction Collection</button>
		</div>
	</form>
</div>

<?php
}

function createSelect(){
	?>
		<div class="form-group">
				<label for="formControlSelectComposition">Composition</label>
				<select class="form-control form-control-lg" id="formControlSelectComposition" name="thiscomposition">
				<?php

					$dbc = connectToDB();
					$query = "SELECT compositionID, compositionname from composition";
					$result = performQuery($dbc, $query);
					while ($row=mysqli_fetch_array($result, MYSQLI_ASSOC)){
						$id = $row['compositionID'];
						$name = $row['compositionname'];

					 	if (isset($_POST['thiscomposition']) && ($_POST['thiscomposition']==$id))
							echo "<option value = \"$id\" selected>$name</option>\n";
						else
							echo "<option value = \"$id\">$name</option>\n";
					}
					disconnectFromDB($dbc, $result)
					?>
				</select>
		</div>
<?php
}


function displayCollectionForm(){
	?>
	<form action="" method="post">
		<div class="form-group row">
			<label for="composerName" class="col-sm-2 col-form-label">Composer</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="composerName" id="composerName" placeholder="Composer Name">
			</div>
		</div>
		<div class="form-group row">
			<label for="composition Name" class="col-sm-2 col-form-label">Composition</label>
			<div class="col-sm-10">
				<input type="text" class="form-control" name="compositionName" id="compositionName" placeholder="Composition Name">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" name="createcollection" value="createcollection">Create Collection Site</button>
			</div>
		</div>
	</form>
<?php
}
function handleCollectionForm(){

	$dbc = connectToDB();
	$composerName = $_POST['composerName'];
	$compositionName = $_POST['compositionName'];
	$query = "INSERT INTO composition (compositionID, composername, compositionname, collectioneabled) VALUES (NULL, '$composerName', '$compositionName', 0);";
	performQuery($dbc, $query);
}
function handleEnableCollectionForm(){
	if (isset($_POST['thiscomposition']))
		$id = $_POST['thiscomposition'];
	$query = "UPDATE composition SET collectionenabled = true WHERE compositionID = $id";
	//die( $query);
	$dbc = connectToDB();
	performQuery($dbc, $query);
}
function handleDisableCollectionForm(){
	if (isset($_POST['thiscomposition']))
		$id = $_POST['thiscomposition'];
	$query = "UPDATE composition SET collectionenabled = false WHERE compositionID = $id";
	//die( $query);

	$dbc = connectToDB();
	performQuery($dbc, $query);
}
