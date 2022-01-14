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

    STOP = 12 # pin 32
    EN = 4   # pin 7
    DIR = 20 # pin 38
    STEP = 21 # pin 40

    GPIO.setup([EN, DIR, STEP], GPIO.OUT, initial=0)
    GPIO.setup(STOP, GPIO.IN, pull_up_down=GPIO.PUD_UP) # Кнопку в режим INPUT, к нулю с подтяжкой к единице
    #GPIO.setwarnings(False) # не выводить предупреждения

    all_steps = 5960 # всего шагов на круг
    size_step = 2 # деление шага 1/2

    delay = 0.0007 / size_step # 0.0857
    step_count = all_steps * size_step
    hf = step_count // 2 # половини круга 1/2
    qr = step_count // 4 # четверть круга 1/4
    ei = step_count // 8 # восьмушка 1/8

    print("Вращение в лево -> ")
    for x in range(hf):
        speed = delay

        if x >= qr - 200 and x <= qr + 200:
            speed = delay * 8

        if x >= qr + ei - 200 and x <= qr + ei + 200:
            speed = delay * 8

        GPIO.output(STEP, GPIO.HIGH)
        time.sleep(speed)
        GPIO.output(STEP, GPIO.LOW)
        time.sleep(speed)
        #print(x)

        if GPIO.input(STOP) == GPIO.HIGH:
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
