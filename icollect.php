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
		<div class="jumbotron" id="managecollection">
			<h3 class="display-4">Manage collections</h3>
			<div class="card">
				<h5 class="card-title">Collection status</h5>
				<div class="card-body">
					<div class="alert alert-info" role="alert">
						<?php  displayEnabledCollection(); ?>
					</div>
					<?php    displayEnableForm(); ?>
				</div>
			</div>

		<div class="jumbotron" id="collectreaction">
			<h1 class="display-4">messing with audio</h1>
			<a id="download">Download</a>
	<button id="stop">Stop</button>
	<script>
	  let shouldStop = false;
	  let stopped = false;
	  const downloadLink = document.getElementById('download');
	  const stopButton = document.getElementById('stop');

	  stopButton.addEventListener('click', function() {
	    shouldStop = true;
	  });

	  const handleSuccess = function(stream) {
	    const options = {mimeType: 'audio/webm'};
	    const recordedChunks = [];
	    const mediaRecorder = new MediaRecorder(stream, options);

	    mediaRecorder.addEventListener('dataavailable', function(e) {
	      if (e.data.size > 0) {
	        recordedChunks.push(e.data);
	      }

	      if(shouldStop === true && stopped === false) {
	        mediaRecorder.stop();
	        stopped = true;
	      }
	    });

	    mediaRecorder.addEventListener('stop', function() {
	      downloadLink.href = URL.createObjectURL(new Blob(recordedChunks));
	      downloadLink.download = 'acetest.wav';
	    });

	    mediaRecorder.start();
	  };

	  navigator.mediaDevices.getUserMedia({ audio: true, video: false })
	      .then(handleSuccess);

	</script>
		</div>
	<div class="jumbotron" id="controlcollection">
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
		<?php
		createCompositionSelect();
		?>
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
