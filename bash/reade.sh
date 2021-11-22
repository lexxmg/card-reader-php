#!/bin/bash

tesseract -l rus  --dpi 300 --psm 6 /var/www/html/upload/result.png /var/www/html/upload/result;

#cat /var/www/html/upload/result.txt;

exit 0;
