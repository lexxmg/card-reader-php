import config
import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    STOP = config.STOP
    EN = config.EN
    DIR = config.DIR
    STEP = config.STEP
    LED = config.LED

    GPIO.setup([DIR, STEP, LED], GPIO.OUT, initial=0)
    GPIO.setup(EN, GPIO.OUT, initial=1)
    GPIO.setup(STOP, GPIO.IN, pull_up_down=GPIO.PUD_UP) # Кнопку в режим INPUT, к нулю с подтяжкой к единице
    #GPIO.setwarnings(False) # не выводить предупреждения

except KeyboardInterrupt:
    # ...
    print("Exit pressed Ctrl+C")                # Выход из программы по нажатию Ctrl+C
except:
    # ...
    print("Other Exception")                    # Прочие исключения
    print("--- Start Exception Data:")
    traceback.print_exc(limit=2, file=sys.stdout) # Подробности исключения через traceback
    print("--- End Exception Data:")
finally:
    print("GPIO Проиницилзированы")                            # Информируем сбросе пинов
    sys.exit()
