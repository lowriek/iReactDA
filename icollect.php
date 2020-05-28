<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!-- Required meta tags -->
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	 <!-- Bootstrap CSS -->
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	 <title>Create Collection Point (admin page)</title>
</head>
<body>
	<pre>
		<?php //print_r( $_POST ); ?>
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
	<div class="container-fluid">
		<h3 class="display-4">Manage collections</h3>
		<div class="card">
			<h5 class="card-title">Collection status</h5>
			<div class="card-body">
				<div class="alert alert-info" role="alert">
					<?php  displayEnabledCollectionCount(); ?>
				</div>
				<?php    displayEnableForm(); ?>
			</div>
		</div>

		<div class="card">
				<h4 class="card-title">Enter Composition</h4>
				<div class="card-body">
					<div class="container" id="entercomposition">
					<?php
						displayEnterCompositionForm();
					?>
					</div>
				</div>
		</div>
		<div class="card">
				<h4 class="card-title">Enter Collection</h4>
				<div class="container" id="entercollection">
					<?php
						displayCreateCollectionForm();
					?>
				</div>
		</div>
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
	<div class="input-group mb-3">
	  <div class="input-group-prepend" id="button-addon3">
			<button type="submit" class="btn btn-primary" name="enablecollection" value="1">Enable Collection</button>
			<button type="submit" class="btn btn-primary" name="disablecollection" value="1">Disable Collection</button>
	  </div>
		<?php createCollectionSelect(); ?>
	</div>
</form>

<?php
}

function createCompositionSelect(){
	?>
				<select class="form-control" name="thiscomposition">
					<option value="placeholder" disabled>Select a composition</option>
					<?php	echo getCompositionOptions();	?>
				</select>
<?php
}

function createCollectionSelect(){
	?>
				<select class="form-control" name="thiscollection">
					<option value="placeholder" disabled>Select a collection</option>
					<?php   echo getCollectionOptions(); ?>
				</select>
<?php
}

function displayEnterCompositionForm(){
	?>
	<form action="" method="post">
		<div class="form-group">
     <input type="text" class="form-control" id="composerName" name="composerName" placeholder="Enter the composer's name">
		 <input type="text" class="form-control" id="compositionName" name="compositionName" placeholder="Enter the composition name">
		 <button type="submit" class="btn btn-primary" name="entercomposition" value="entercomposition">Enter Composition</button>
		</div>
	</form>
<?php
}

function displayCreateCollectionForm(){
	?>
	<form action="" method="post">
		<input type="text" class="form-control" name="collectiondescription" id="collectiondescription" placeholder="Enter the collection description (performance details)">
		<input type="text" class="form-control" name="collectionurl" id="collectionurl" placeholder="Enter the URL of the collection">
		<?php
		createCompositionSelect();
		?>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
		  <label class="form-check-label" for="exampleRadios1">
		    Default radio
		  </label>
		</div>
		<div class="form-check">
		  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
		  <label class="form-check-label" for="exampleRadios2">
		    Second default radio
		  </label>
		</div>
		<div class="form-check disabled">
		  <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios3" value="option3" disabled>
		  <label class="form-check-label" for="exampleRadios3">
		    Disabled radio
		  </label>
		</div>
		<button type="submit" class="btn btn-primary" name="createcollection" value="createcollection">Create Collection Site</button>
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
