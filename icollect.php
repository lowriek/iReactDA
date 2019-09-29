<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Create Collection Point (admin page)</title>
	<!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	 <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>
<body>
	<pre>
		<?php print_r( $_POST ); ?>
	</pre>
	<?php
	include 'php/dbsupport.php';

	if(isset($_POST['entercomposition'])) {
		handleCompositionForm();
	}
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

	<div class="jumbotron" id="entercomposition">
		<h1 class="display-4">Enable/Disable Collection</h1>
		<?php
			displayEnabledCollection();
			displayEnableForm();
		?>
	</div>
	<div class="jumbotron" id="entercomposition">
		<h1 class="display-4">Enter Composition</h1>
		<?php
			displayEnterCompositionForm();
		?>
	</div>

	<div class="jumbotron" id="collectreaction">
		<h1 class="display-4">Create Collection</h1>
		<?php
			displayCollectionForm();
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
	<?php createCollectionSelect(); ?>
		<div class="form-group row">
			<button type="submit" class="btn btn-primary" name="enablecollection" value="1">Enable Collection</button>
		</div>
		<div class="form-group row">
			<button type="submit" class="btn btn-primary" name="disablecollection" value="1">Disable Collection</button>
		</div>
	</form>
</div>

<?php
}

function createCompositionSelect(){
	?>
		<div class="form-group">
				<select class="form-control form-control-lg" name="thiscomposition">
				<?php
					echo getCompositionOptions();
				?>
				</select>
		</div>
<?php
}

function createCollectionSelect(){
	?>
		<div class="form-group">
				<select class="form-control form-control-lg" name="thiscollection">
				<?php
					echo getCollectionOptions();
				?>
				</select>
		</div>
<?php
}

function displayEnterCompositionForm(){
	?>
	<form action="" method="post">
		<div class="form-group row">
			<div class="col-sm-10">
				<input type="text" class="form-control" name="composerName" id="composerName" placeholder="Composer Name">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-10">
				<input type="text" class="form-control" name="compositionName" id="compositionName" placeholder="Composition Name">
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" name="entercomposition" value="entercomposition">Enter Composition</button>
			</div>
		</div>
	</form>
<?php
}

function displayCollectionForm(){
	?>
	<form action="" method="post">
		<div class="form-group row">
			<div class="col-sm-10">
				<input type="text" class="form-control" name="collectiondescription" id="collectiondescription" placeholder="Collection Description">
			</div>
		</div>
		<?php
		createCompositionSelect();
		?>
		<div class="form-group row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" name="createcollection" value="createcollection">Create Collection Site</button>
			</div>
		</div>
	</form>
<?php
}

function handleCollectionForm(){

		if (isset($_POST['collectiondescription'])){
			$description = $_POST['collectiondescription'];
		}
		if (isset($_POST['thiscomposition'])){
			$compositionID = $_POST['thiscomposition'];
		}

		createCollection($compositionID, $description);

}
function handleCompositionForm(){
	if (isset($_POST['composerName'])){
		$composerName = $_POST['composerName'];
	}
	if (isset($_POST['compositionName'])){
		$compositionName = $_POST['compositionName'];
	}

	createComposition($composerName, $compositionName);
}

function handleEnableCollectionForm(){

	if (isset($_POST['thiscollection'])) {
		enableCollection($_POST['thiscollection']);
	} else {
		echo "Please select a collection to enable";
	}
}

function handleDisableCollectionForm(){
	if (isset($_POST['thiscollection'])) {
		disableCollection($_POST['thiscollection']);

	} else {
			echo "Please select a collection to disable";
	}
}

?>
