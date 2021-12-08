import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений


try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    #irStop=12 # pin 32
    #pinPWM=16 # pin 36
    DIR = 20 # pin 38
    STEP = 21 # pin 40

    delay = 0.0015
    step_count = 1000

    GPIO.setup([DIR, STEP], GPIO.OUT, initial=0)     # Пины со светодиодом в режим OUTPUT, выключены
    #GPIO.setup(irStop, GPIO.IN, pull_up_down=GPIO.PUD_UP)   # Кнопку в режим INPUT, к нулю с подтяжкой к единице

    print("Вращение в лево -> ")
    for x in range(step_count):
        GPIO.output(STEP, GPIO.HIGH)
        time.sleep(delay)
        GPIO.output(STEP, GPIO.LOW)
        time.sleep(delay)
        #print(x)

    time.sleep(2)

    print("Вращение в право -> ")
    GPIO.output(DIR, GPIO.HIGH)

    for x in range(step_count):
        GPIO.output(STEP, GPIO.HIGH)
        time.sleep(delay)
        GPIO.output(STEP, GPIO.LOW)
        time.sleep(delay)
        #print(x)

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
    #GPIO.cleanup()                              # Возвращаем пины в исходное состояние
    GPIO.output(STEP, GPIO.LOW)
    GPIO.output(DIR, GPIO.LOW)
    print("End of program")                     # Информируем о завершении работы программы
    sys.exit()
