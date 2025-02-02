#!/bin/bash


/usr/bin/php /var/www/html/scan/scanner.php > /dev/shm/lastscan

sleep 25

/usr/bin/php /var/www/html/scan/scanner.php > /dev/shm/lastscan


#sleep 28


#php /var/www/html/scan/scanner.php > /dev/null

