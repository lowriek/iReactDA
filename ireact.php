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
	<div class="jumbotron">
	  <h1 class="display-4">Reactions for DA</h1>
			<div class="container-fluid" id="currentcollection">

<div class="jumbotron" >
	<h3>
			<?php
			include 'php/dbsupport.php';
			displayEnabledCollection();
			?>
	</h3>
			<div class="container-fluid" id="recordreactioninterface">
				<ul class="list-group" style='font-size:50px;'>
					<li class="list-group-item" id="happyreaction">&#128578;</li>
					<li class="list-group-item" id="neutralreaction">&#128528;</li>
					<li class="list-group-item" id="sadreaction">&#128577;</li>
				</ul>

				<form>
					<button class="btn btn-primary btn-lg btn-block" href="#" role="button" id="donereacting">Done!</button>
				</form>
			</div>

			<div class="container-fluid" id="displayreactioninterface">
				<div class="row" id="chartreaction">
					<div class="col">
						<div id="chart_div"></div>
					</div>
				</div>

				<div class="row" id="morereacting">
					<div class="col">
					<a class="btn btn-primary btn-lg btn-block" href="#" role="button" id="morereacting">Again!</a>
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
	<script src="js/reaction.js"></script>

</body>
</html>
