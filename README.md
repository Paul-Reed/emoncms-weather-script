emoncms-weather-script
======================

A script to parse data from Wunderground.com and -
1) input the data feeds into emoncms via Curl
2) create and update a 'current conditions' image file, which can be image linked from your dashboard

Add the script to a location of choice, in my case;
/home/pi/scripts

Edit the script with the details shown in the script itself;
$ sudo nano weather.php

Create a cron job to run the script as often as required;
$ sudo crontab -e
and add to the bottom of the file
*/15 * * * * /usr/bin/php /home/pi/myscripts/weather.php
which will run the script every 15 minutes on the hour.

When run, corresponding inputs will be automatically created and updated in emoncms. 

Forum help - http://openenergymonitor.org/
