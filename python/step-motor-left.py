import config
import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений
import math

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    STOP = config.STOP
    EN = config.EN
    DIR = config.DIR
    STEP = config.STEP

    GPIO.setup([EN, DIR, STEP], GPIO.OUT, initial=0)
    GPIO.setup(STOP, GPIO.IN, pull_up_down=GPIO.PUD_UP) # Кнопку в режим INPUT, к нулю с подтяжкой к единице
    # #GPIO.setwarnings(False) # не выводить предупреждения

    all_steps = config.ALL_STEPS
    size_step = config.SIZE_STEP

    delay = config.DELAY_TO_STEP / size_step
    step_count = all_steps * size_step
    hf = step_count // 2 # половини круга 1/2
    qr = step_count // 4 # четверть круга 1/4
    ei = step_count // 8 # восьмушка 1/8
    si = step_count // 16 # восьмушка 1/16
    th = step_count // 32 # восьмушка 1/32
    six = step_count // 64 # восьмушка 1/64


    print("Вращение в лево -> ")
    for x in range(si):
        GPIO.output(STEP, GPIO.HIGH)
        time.sleep(delay)
        GPIO.output(STEP, GPIO.LOW)
        time.sleep(delay)


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
    print("CleanUp -> ")                            # Информируем сбросе пинов
    # GPIO.cleanup()                              # Возвращаем пины в исходное состояние
    GPIO.output(STEP, GPIO.LOW)
    GPIO.output(DIR, GPIO.LOW)
    GPIO.output(EN, GPIO.HIGH)
    print("End of program")                     # Информируем о завершении работы программы
    sys.exit()
