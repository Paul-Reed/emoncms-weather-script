<html>
<?php
//Original script by Martin Harizanov - http://harizanov.com/ minor edits by Paul Reed
//Get a Wunderground API key from - http://www.wunderground.com/weather/api/
//Documentation - http://www.wunderground.com/weather/api/d/documentation.html

//Change the weather underground API and city below
$json_string = file_get_contents("http://api.wunderground.com/api/your-api-key/conditions/q/pws:IFINNING3.json");
$parsed_json = json_decode($json_string);

$location = $parsed_json->{'current_observation'}->{'display_location'}->{'city'};
$humidity = $parsed_json->{'current_observation'}->{'relative_humidity'};
$pressure = $parsed_json->{'current_observation'}->{'pressure_mb'};
$wind_mph = $parsed_json->{'current_observation'}->{'wind_mph'};
$wind_g_mph = $parsed_json->{'current_observation'}->{'wind_gust_mph'};
$rain_hr = $parsed_json->{'current_observation'}->{'precip_1hr_metric'};
$rain_today = $parsed_json->{'current_observation'}->{'precip_today_metric'};

//Get and save the icon_url to /pictures
$image_url = $parsed_json->{'current_observation'}->{'icon_url'};
$current_con = '/var/www/images/current_con.gif';
file_put_contents($current_con, file_get_contents($image_url));

//The following line can be used to screen print the variables 
//echo "\nCurrent relative humidity in ${location} is: ${humidity}\n";
 
//Change the URL and EmonCMS API below
$url = 'http://url/emoncms/api/post?apikey=your-emoncms-api-key&json={humidity:' . $humidity . ',pressure:' . $pressure . ',wind:' . $wind_mph . ',windgust:' . $wind_g_mph . ',rain_today:' . $rain_today . ',rain_hr:' . $rain_hr .'}';
echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$contents = curl_exec ($ch);
curl_close ($ch);
 
?>
</html>
