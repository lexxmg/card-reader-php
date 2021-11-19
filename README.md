# card-reader-php

установить:
sudo apt-get update
sudo apt-get install -y tesseract-ocr
tesseract --version

использовать:
tesseract --dpi 300 /var/www/html/upload/num.png /tmp/result   # запишит результат в  /var/www/html/upload/result.txt
tesseract --dpi 300 /var/www/html/upload/num.png stdout        # выведет результат в терминал

присвоить права:
sudo chmod +x /var/www/html/bash/reade.sh
sudo chmod 777 /var/www/html/upload
