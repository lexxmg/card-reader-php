# card-reader-php

установить:
  sudo apt-get update
  sudo apt-get install -y tesseract-ocr
  sudo apt install tesseract-ocr-rus
  ###sudo apt install ocrfeeder tesseract-ocr-rus
  tesseract --version
  sudo apt-get install apache2
  apache2 -version
  sudo apt-get install php libapache2-mod-php
  sudo apt-get install php7.4-gd
  ###sudo apt-get install php7.3-fpm php7.3-cli php7.3-curl php7.3-gd php7.3-cgi

Добваить в конфиг:
  sudo nano /etc/sudoers
  добавить строку:
    www-data ALL=(ALL) NOPASSWD:ALL

  sudo nano /etc/rc.local
  добавить строку до exit 0:
    sudo python /var/www/html/python/gpio_start.py &
    ### если нужны логи то: sudo python /var/www/html/python/gpio_start.py & > /home/pi/PythonScripts/script_log.txt 2>&1

использовать:
  tesseract --dpi 300 /var/www/html/upload/num.png /tmp/result   # запишит результат в  /var/www/html/upload/result.txt
  tesseract --dpi 300 /var/www/html/upload/num.png stdout        # выведет результат в терминал
  tesseract -l rus  --dpi 300 --psm 6 /var/www/html/upload/result.png stdout  # выведет результат в терминал

присвоить права:
  sudo chmod +x /var/www/html/bash/reade.sh
  sudo chmod +x /var/www/html/bash/right.sh
  sudo chmod 777 /var/www/html/upload
  sudo chmod 777 /var/www/html/storage
  sudo chmod +x /var/www/html/bash/reboot.sh

Камера:
  включить в конфиге:
    sudo raspi-config
  использовать:   
    libcamera-jpeg -o /tmp/test.jpg


GPIO:
  По умолчанию все пины (кроме BCM14 и BCM15) находятся в режиме INPUT, причем пины BCM0-BCM8 и BCM15 подтянуты к единице подтягивающими резисторами (pullup). Именно по этой причине мультиметр покажет напряжение на этих пинах. Остальные пины стянуты к нулю.

  25		
  Каждый из 28 пинов снабжен подтягивающим (pullup) и стягивающим (pulldown) резистором, благодаря чему, в режиме INPUT может быть подтянут к логической единице, либо стянут к нулю.
  О том для чего нужны стягивающие/подтягивающие резисторы можно почитать в статье.

  26		
  Номиналы сопротивлений не постоянны и равны:
  для подтягивающего резистора 50 КОм — 65 КОм
  для стягивающего резистора 50 КОм — 60 КОм

  27		
  Номинал сопротивления подтягивающего/стягивающего резистора для пинов BCM2 и BCM3 — 1.8 КОм.

  28		
  Каждый из 28 пинов в режиме INPUT может генерировать прерывания — по спаду, по фронту, по единице, по нулю, по изменению сигнала, а также в асинхронном режиме по фронту и по спаду:

  pin=14
  GPIO.setup(pin, GPIO.IN)  # Режим INPUT - чтение состояния
  # или
  GPIO.setup(pin, GPIO.OUT) # Режим OUTPUT - установка состояния

  pin=25
  GPIO.setup(pin, GPIO.IN, pull_up_down=GPIO.PUD_DOWN) # При установке режима пина, стягиваем его к нулю
  # или
  GPIO.setup(pin, GPIO.IN, pull_up_down=GPIO.PUD_UP)   # При установке режима пина, подтягиваем его к единице
  # или
  GPIO.setup(pin, GPIO.IN, pull_up_down=GPIO.PUD_OFF)  # При установке режима пина, отключаем подтягивание/стягивание

  pin=14
  GPIO.setup(pin, GPIO.OUT, initial=GPIO.HIGH)  # Инициализация пина в режим OUTPUT со значением логическая единица HIGH
  # или
  GPIO.setup(pin, GPIO.OUT, initial=GPIO.LOW)   # Инициализация пина в режим OUTPUT со значением логический ноль LOW


Прерывания:
  Синтаксис	Описание
  GPIO.add_event_detect(pin, event	Функция начинает отслеживать событие на заданном пине, аргументы:
  pin — номер пина,
  event — событие, может принимать 3 значения:

  GPIO.RISING — изменение сигнала по фронту (LOW→HIGH)
  GPIO.FALLING — изменение сигнала по спаду (HIGH→LOW)
  GPIO.BOTH — изменение сигнала и по фронту, и по спаду (LOW→HIGH и HIGH→LOW)
  GPIO.event_detected(pin)	Результат работы функции — флаг True/False, сигнализирующий о том, наступило ли заданное событие:

  True — с начала наблюдения, заданное событие наступало
  False — с начала наблюдения, заданное событие не наступало
  pin — номер пина.
