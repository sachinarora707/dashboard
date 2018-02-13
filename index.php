<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<title>My Dashboard</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body style="width: 100%; padding: 0; margin: 0;">

	<div class="row">
		<div class="col-12" style="text-align: center; padding: 5px 0px; margin-top: 10px;">
			<b>Time (USA):</b> <?php 
			$Time = new DateTime("now");
			$Time->setTimezone(new DateTimeZone("EST"));
			echo $Time->format("h:i:s a") ?>
		</div>
	</div>
	<div class="row">	
		<div  class="col-4">
			<div id="weatherWidget">
				<?php require_once('weather.php') ?>
			</div>
		</div>
		
		<div class="col-4">
			<div id="alexaWidget">
				<?php require_once('alexa.php') ?>
			</div>
		</div>

		<div class="col-4">
			<div id="alexaWidget2">
				<?php require_once('alexa2.php') ?>
			</div>
		</div>
	</div>

	<div class="row">
		
		<div class="col-3">
			<div class="cryptoWidget" style="margin-left: 15px ">
				<?php require_once('cryptoWidgets/btcWidget.php') ?>
			</div>
		</div>

		<div class="col-3">
			<div class="cryptoWidget">
				<?php require_once('cryptoWidgets/navWidget.php') ?>
			</div>
		</div>

		<div class="col-3">
			<div class="cryptoWidget">
				<?php require_once('cryptoWidgets/bnbWidget.php') ?>
			</div>
		</div>

		<div class="col-3">
			<div class="cryptoWidget">
				<?php require_once('cryptoWidgets/stellarWidget.php') ?>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-12">
			<div id="notepad">
				<?php require_once('notepad.php') ?>
			</div>
		</div>
	</div>

</body>
</html>