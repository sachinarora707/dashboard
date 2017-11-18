<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>My Dashboard</title>
</head>
<body style="width: 100%; padding: 0; margin: 0;">
	<div class="row">
		<div id="weatherWidget" class="col-4">
			<?php require_once('weather.php') ?>
		</div>
	</div>
</body>
</html>