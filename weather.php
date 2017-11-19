<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.openweathermap.org/data/2.5/forecast?q=chandigarh&cnt=20&units=metric&appid=80d3dbbe7e71bb7d30a1a75f399cb9c8",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$weatherAPI = json_decode($response);
	$weather = $weatherAPI -> list;
	date_default_timezone_set("UTC");
}
 ?>

<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://api.openweathermap.org/data/2.5/weather?q=chandigarh&units=metric&appid=80d3dbbe7e71bb7d30a1a75f399cb9c8",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "GET",
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
  echo "cURL Error #:" . $err;
} else {
	$currWeather = json_decode($response);
}
 ?>


<p style="clear: both; text-align: center; margin: 0; font-family: Helvetica, monospace; font-size: small; font-weight: bold;">
	<?php echo date("D d-M-y")?>
</p>
<p style="float:left; clear: both; width:50%; font-family: Helvetica, monospace; font-size:51px; margin: 0;">
	<span style="font-size: 50px;"><?php echo round($currWeather->main->temp); ?></span><sup style="font-size: x-large">&#8451</sup>
	<span style="font-size: 20px">Overcast</span>
</p>
<p style="float: right; width: 50%;">
	<input type="text" name="city" value="Chandigarh" id="weatherCity"></input>
</p>
<div style="clear: both; border: 0.3px solid"></div>
<div class="row">
	<?php 
		for($x=1; $x<11; $x+=3){
				$forecastTime = new DateTime($weather[$x]->dt_txt);
				$forecastTime->setTimezone(new DateTimeZone("Asia/Kolkata"));
				//echo $forecastTime->format("Y-m-d H:i:s");

			echo '<div class="col-3 weatherDay">
			<p style="font-size: larger;">' . $forecastTime->format("D") . '</p>
			<p style="font-size: x-small;">' . $forecastTime->format("h:i a") . '</p>
			<img src="http://openweathermap.org/img/w/' . $weather[$x]->weather[0]->icon .'.png" style="width: 50px; height: 50px;"/>
			<p style="font-size: x-small;">' . $weather[$x]->weather[0]->main .'</p>
			<p style="font-size: larger;">' . $weather[$x]->main->temp . '&#8451</p>
			</div>';
		}
	 ?>
</div>
<script>
	function borderAdd(){
		document.getElementsByClassName('weatherDay')[0].style.borderLeftWidth= '0.5px';
	}
	borderAdd();
</script>