import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

# GPIO.IN = 1
# GPIO.OUT = 0
# GPIO.SPI = 41
# GPIO.I2C = 42
# GPIO.HARD_PWM = 43
# GPIO.SERIAL = 40
# GPIO.UNKNOWN = -1

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    irStop=12 # pin 32
    #pinPWM=16 # pin 36
    EN = 4   # pin 7
    DIR = 20 # pin 38
    STEP = 21 # pin 40

    size_step = 2
    delay = 0.0007 / size_step # 0.0857
    step_count = 5960 * size_step

    print(step_count)
    #GPIO.setwarnings(False)

    GPIO.setup(EN, GPIO.OUT, initial=0)

    #if GPIO.gpio_function(DIR) ==  GPIO.UNKNOWN:
    GPIO.setup(DIR, GPIO.OUT, initial=0)

    #if GPIO.gpio_function(STEP) ==  GPIO.UNKNOWN:
    GPIO.setup(STEP, GPIO.OUT, initial=0)

    #GPIO.setup([DIR, STEP], GPIO.OUT, initial=0)     # Пины со светодиодом в режим OUTPUT, выключены
    #GPIO.setup(irStop, GPIO.IN, pull_up_down=GPIO.PUD_UP)   # Кнопку в режим INPUT, к нулю с подтяжкой к единице
    GPIO.setup(irStop, GPIO.IN, pull_up_down=GPIO.PUD_UP)

    print("Вращение в лево -> ")
    for x in range(step_count // 4):
        GPIO.output(STEP, GPIO.HIGH)
        time.sleep(delay)
        GPIO.output(STEP, GPIO.LOW)
        time.sleep(delay)
        #print(x)

    time.sleep(.5)

    print("Вращение в лево -> ")
    for x in range(step_count // 4):
        GPIO.output(STEP, GPIO.HIGH)
        time.sleep(delay)
        GPIO.output(STEP, GPIO.LOW)
        time.sleep(delay)
        #print(x)
        if GPIO.input(irStop) == GPIO.HIGH:
            break

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