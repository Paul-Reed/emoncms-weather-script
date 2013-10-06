<html>
<?php
//Original script by Martin Harizanov - http://harizanov.com/ minor edits by Paul Reed
//Get a Wunderground API key from - http://www.wunderground.com/weather/api/
//Documentation - http://www.wunderground.com/weather/api/d/documentation.html

//Change the weather underground API and city below
$json_string = file_get_contents("http://api.wunderground.com/api/XXXXX-My-API-Key-XXXXX/conditions/q/pws:ICANTLEY2.json");
$parsed_json = json_decode($json_string);

$location = $parsed_json->{'current_observation'}->{'display_location'}->{'city'};
$relative_humidity = $parsed_json->{'current_observation'}->{'relative_humidity'};
$pressure_mb = $parsed_json->{'current_observation'}->{'pressure_mb'};
$wind_mph = $parsed_json->{'current_observation'}->{'wind_mph'};
$wind_gust_mph = $parsed_json->{'current_observation'}->{'wind_gust_mph'};

//Get and save the icon_url to /images
$image_url = $parsed_json->{'current_observation'}->{'icon_url'};
//Change the required location of downloaded image file
$current_con = '/var/www/images/current_con.gif';
file_put_contents($current_con, file_get_contents($image_url));

echo "\nCurrent relative humidity in ${location} is: ${relative_humidity}\n";
//Can duplicate the above echo statement for wind, pressure, etc. if needed

//Change the URL and EmonCMS API below
$url = 'http://yourURL/emoncms/api/post?apikey=XXXXX-My-API-Key-XXXXX&json={humidity:' . $relative_humidity . ',pressure:' . ',wind:' . $wind_mph . ',windgust:' . $wind_gust_mph .'}'; $pressure_mb . '$
echo $url;
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$contents = curl_exec ($ch);
curl_close ($ch);

?>
</html>
