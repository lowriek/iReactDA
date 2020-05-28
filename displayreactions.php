<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Display reactions</title>
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

	<div class="jumbotron" id="displayreaction">
	  <h1 class="display-4">Display reactions to a composition</h1>
		<div>
		<?php
		include 'php/dbsupport.php';
		if ( isset( $_POST['collectionID'] ) ){
		    handleSelectCollectionForm();
		}
		displaySelectCollectionForm();
		?>
	</div>

		<div class="row" id="chartreaction">
			<div class="col">
				<div id="chart_div"></div>
			</div>
		</div>

</div>

<script
src="https://code.jquery.com/jquery-3.4.1.min.js"
integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script src="js/displayreactions.js"></script>

</body>
</html>
<?php
function handleSelectCollectionForm(){

}
function displaySelectCollectionForm(){ // should only allow one compostion to collect...
		// display the current collection info for the user and to have for storing later
?>
<?php
    if (isset($_POST['collectionID']) ){
			$cid = $_POST['collectionID'];
			echo "<div id='currentcollectionID'> $cid</div>";
		} else {
			$cid = 0;
		}
?>
		<form action="" method="post">
			<div class="input-group mb-3">
				<div class="input-group-prepend" id="button-addon3">
					<?php createVideoSelect($cid); ?>
					<button type="submit" class="btn btn-primary" name="collectionIDbutton" value="1">Choose Collection</button>
				</div>
			</div>
		</form>
<?php
}

function createVideoSelect($id){
?>
				<select class="form-control" name="collectionID">
					<option value="placeholder" disabled>Select a collection</option>
					<?php   echo getCollectionOptions($id); ?>
				</select>
<?php
}
