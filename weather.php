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
 // echo "cURL Error #:" . $err;
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
//  echo "cURL Error #:" . $err;
} else {
	$currWeather = json_decode($response);
}
 ?>


<p style="clear: both; text-align: center; margin: 0; font-family: Helvetica, monospace; font-size: small; font-weight: bold;">
	<?php echo date("D d-M-y", time()+19800)?>
</p>
<p style="float:left; clear: both; width:50%; font-family: Helvetica, monospace; font-size:51px; margin: 0;">
	<span style="font-size: 50px;" id="temp"><?php if(isset($currWeather)){ echo round($currWeather->main->temp); }?></span><sup style="font-size: x-large">&#8451</sup>
	<span style="font-size: 20px">Overcast</span>
</p>
<p style="float: right; width: 50%;">
		<input type="text" name="city" value="Chandigarh" id="weatherCity" onchange="getWeather()"></input>
</p>
<div style="clear: both; border: 0.3px solid"></div>
<div style="margin: 3% 0 0 0">
<table style="border-collapse: collapse; width: 100%;">
	<tr>
		<?php 
		if(isset($weather)){
			for($x=1; $x<11; $x+=3){
				$forecastTime = new DateTime($weather[$x]->dt_txt);
				$forecastTime->setTimezone(new DateTimeZone("Asia/Kolkata"));
				echo '<td class="weatherDay">
				<p style="font-size: larger;">' . $forecastTime->format("D") . '</p>
				<p style="font-size: x-small;">' . $forecastTime->format("h:i a") . '</p>
				<img src="http://openweathermap.org/img/w/' . $weather[$x]->weather[0]->icon .'.png" style="width: 50px; height: 50px;"/>
				<p style="font-size: x-small;">' . $weather[$x]->weather[0]->main .'</p>
				<p style="font-size: larger;">' . $weather[$x]->main->temp . '&#8451</p>
				</td>';
			}
		}
		 ?>
	</tr>
</table>
</div>
<script>
	function getWeather(){
		var city = document.getElementById('weatherCity').value;
		var weather = "";
		var forecast = "";
		
		var xhttp = new XMLHttpRequest();
		xhttp.onreadystatechange=function() {	
   		 if (this.readyState==4 && this.status==200) {
	   		 	weather = this.responseText;
	   		 	weather = JSON.parse(weather);
	   		 	update();
   		 }
   		};
   		xhttp.open("GET","http://api.openweathermap.org/data/2.5/weather?q="+ $("#weatherCity").val() + "&units=metric&appid=80d3dbbe7e71bb7d30a1a75f399cb9c8",true)
   		xhttp.send();


   		function update(){
   			$("#temp").text(Math.round(weather["main"]["temp"]));


   			//forecast update
		xhttp.onreadystatechange=function() {	
		 if (this.readyState==4 && this.status==200) {
   		 	forecast = this.responseText;
   		 	forecast = JSON.parse(forecast);
   		 	forecast = forecast["list"];
   		 	console.log(forecast); //remove this line
   		 	updateForecast();
		 }
		};
		xhttp.open("GET","http://api.openweathermap.org/data/2.5/forecast?q="+ $("#weatherCity").val() + "&cnt=20&units=metric&appid=80d3dbbe7e71bb7d30a1a75f399cb9c8",true)
		xhttp.send();
   		
   		function updateForecast(){
   		for(i=1;i<=4;i++){
				var weatherDivs = $("#weatherWidget td.weatherDay:nth-child(" + i + ")");
				weatherDivs.children("p").eq(0).text(getDay(forecast[(3*i)-2]["dt_txt"]));
				weatherDivs.children("p").eq(1).text(timeParser(forecast[(3*i)-2]["dt_txt"]));
				weatherDivs.children("p").eq(2).text(forecast[(3*i)-2]["weather"][0]["main"]);
				weatherDivs.children("p").eq(3).html(forecast[(3*i)-2]["main"]["temp"] + "&#8451");
				weatherDivs.children("img").attr("src","http://openweathermap.org/img/w/" + forecast[(3*i)-2]["weather"][0]["icon"] + ".png");
   			}
   		}

   		function timeParser(a){
   			var msec = Date.parse(a);
			var d = new Date(msec);
			d.setHours(d.getHours() + 5);
			d.setMinutes(d.getMinutes() + 30);
			var hours = d.getHours();
			var minutes = d.getMinutes();
			var ampm;
			if(hours>12){
				ampm = "pm";
			    hours = hours-12;
			}
			else if(hours == 12){
				ampm = "pm"
			}
			else{
				ampm = "am";
			}
			parsedString = hours + ":" + minutes + " " + ampm;
			return parsedString;
   		}
   		function getDay(a){
   			var msec = Date.parse(a);
			var d = new Date(msec);
			d.setHours(d.getHours() + 5);
			d.setMinutes(d.getMinutes() + 30);
			var day = d.getDay();
			var week = ["Sun","Mon","Tue","Wed","Thur","Fri","Sat"];
			return week[day];
   		}
   		}
	}
</script>