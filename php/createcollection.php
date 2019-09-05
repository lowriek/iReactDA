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
	<div class="jumbotron" id="collectreaction">
		<?php
		if(isset($_POST['createcollection'])) {
			handleform();
		}
		displayForm();  // I always want to display the form
		?>
	</div>

	<div class="jumbotron" id="reactionsite">
	  <h1 class="display-4">Gather Reactions for DA</h1>
		<form>
			<button type="submit" class="btn btn-primary">Enable Reaction Collection</button>
		</form>
		<br/>
		<form>
			<button type="submit" class="btn btn-primary">Disable Reaction Collection</button>
		</form>
	</div>


	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="js/reaction.js"></script>

</body>
</html>
<?php

function displayform(){
	?>
	<h1 class="display-4">Create Composition Collection Site</h1>
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
function handleform(){
	include 'php/dbconn.php';

	$dbc = connectToDB();
	$composerName = $_POST['composerName'];
	$compositionName = $_POST['compositionName'];
	$query = "INSERT INTO composition (compositionID, composername, compositionname, collectioneabled) VALUES (NULL, '$composerName', '$compositionName', 0);";
	performQuery($dbc, $query);
}
