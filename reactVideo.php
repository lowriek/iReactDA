<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>Get my reaction!</title>
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
	include 'php/dbsupport.php';
	if(isset($_POST['collectionID'])) {
		$videoinfo = handleSelectVideoForm();
		$videosource = $videoinfo['urlsource'];
		$videocollection = $videoinfo['videodata'];
		$collectionID = $_POST['collectionID'];
	} else {
		$videosource = "No video source selected.";
		$videocollection = "Please choose a video.";
		$collectionID="none";
	}


	?>
	<div class="jumbotron">
	  <h1 class="display-4">Reactions for DA</h1>
		<div class="container-fluid" id="selectcollection">

			<div class="card">
				<div class="card-body">
					<div class="alert alert-info" role="alert">
					<?php  displayEnabledCollectionCount(); echo " $videocollection";  ?>
					</div>
					<?php
						displaySelectVideoForm();
					?>
				</div>
			</div>

		</div>

		<div class="container-fluid" id="currentcollection">

			<div class="container">
			  <div class="row" id="recordreactioninterface">
					<div class="col-lg">

						<div id="stage">
							<!-- 4:3 aspect ratio -->
							<div class="embed-responsive embed-responsive-4by3">
									<video id="myvid"class="video-fluid z-depth-1" controls >
										<?php
											echo $videosource;
										?>
										Your browser does not support the video tag
									</video>
							</div>
							<div id="vidtime"></div>
							<div id="vidstat"></div>
						</div>
					</div>
					<div class="col-lg">
						<p>
							Move your mouse to show your reaction.
							Start the video to start collection.
							Your reactions will be displayed when the video is complete.
						</p>
						<div class="container-fluid" >
									<ul class="list-group" style='font-size:50px;'>
										<li class="list-group-item" id="happyreaction">&#128578;</li>
										<li class="list-group-item" id="neutralreaction">&#128528;</li>
										<li class="list-group-item" id="sadreaction">&#128577;</li>
									</ul>
						</div>
					</div>
				</div>

				<div class	="row" id="displayreactioninterface">
					<div class="col-lg">
						<div class="container-fluid">
							<div class="row" id="chartreaction">
								<div class="col">
									<div id="chart_div"></div>
									<div id="table_div"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="row" >
						<div class="col" id="morereacting">
							<a class="btn btn-primary btn-lg btn-block" href="#" role="button" id="morereacting">Again!</a>
						</div>
						<div class="col" id="savereactionstuff">
							 <input type="text" class="form-control" id="reactionId" placeholder="Enter id string to save">
							 <input type="hidden" id="currentcollectionID" value="<?php echo $collectionID;?>" >
							 <a class="btn btn-primary btn-lg btn-block" href="#" role="button" id="savereactions">Save!</a>
						</div>
					</div>
			</div>

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
	<script src="js/reactionvideo.js"></script>
</body>
</html>
<?php

function handleSelectVideoForm(){

	$id = $_POST['collectionID'];
	$url = getURLbyCollectionID($id);

	$videoinfo['urlsource'] = "<source src='".$url."' type='video/mp4' id='currentvideo'/>";
	$videoinfo['videodata'] = getCurrentCollectionInfoByCollectionID($id);
	return $videoinfo;
}

function displaySelectVideoForm(){ // should only allow one compostion to collect...
		// display the current collection info for the user and to have for storing later
		if (isset($_POST['collectionID'])) {
			$currentcollectionid = $_POST['collectionID'];
		}

?>
<form action="" method="post">
	<div class="input-group mb-3">
	  <div class="input-group-prepend" id="button-addon3">
			<button type="submit" class="btn btn-primary" name="collectionID" value="1">Choose Video</button>
	  </div>
		<?php createVideoSelect(); ?>
	</div>
</form>

<?php
}

function createVideoSelect(){
	?>
				<select class="form-control" name="collectionID">
					<option value="placeholder" disabled>Select a collection</option>
					<?php   echo getVideoURLOptions(); ?>
				</select>
<?php
}
