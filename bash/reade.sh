#!/bin/bash

tesseract -l rus  --dpi 300 --psm 11 /var/www/html/upload/result.jpg /var/www/html/upload/result;

#cat /var/www/html/upload/result.txt;

exit 0;
