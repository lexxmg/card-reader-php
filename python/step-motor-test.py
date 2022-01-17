import config
import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    EN = config.EN
    DIR = config.DIR
    STEP = config.STEP

    GPIO.setup([EN, DIR, STEP], GPIO.OUT, initial=0)
    #GPIO.setwarnings(False) # не выводить предупреждения

    all_steps = config.ALL_STEPS
    size_step = config.SIZE_STEP

    delay = config.DELAY_TO_STEP / size_step # 0.0857
    step_count = all_steps * size_step
    hf = step_count // 2 # половини круга 1/2
    qr = step_count // 4 # четверть круга 1/4

    print("Вращение в право -> ")
    GPIO.output(DIR, GPIO.HIGH)

    for x in range(qr):
        GPIO.output(STEP, GPIO.HIGH)
        time.sleep(delay)
        GPIO.output(STEP, GPIO.LOW)
        time.sleep(delay)

    time.sleep(.2)

    print("Вращение в лево -> ")
    GPIO.output(DIR, GPIO.LOW)

    for x in range(qr):
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
    #print("CleanUp -> ")                            # Информируем сбросе пинов
    #GPIO.cleanup()                              # Возвращаем пины в исходное состояние
    # GPIO.output(STEP, GPIO.LOW)
    # GPIO.output(DIR, GPIO.LOW)
    GPIO.output(EN, GPIO.HIGH)
    print("End of program")                     # Информируем о завершении работы программы
    sys.exit()
