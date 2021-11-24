import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    irStop=12 # pin 32
    motor1=20 # pin 38
    motor2=21 # pin 40

    GPIO.setup([motor1, motor2], GPIO.OUT, initial=0)     # Пины со светодиодом в режим OUTPUT, выключены
    GPIO.setup(irStop, GPIO.IN, pull_up_down=GPIO.PUD_UP)   # Кнопку в режим INPUT, к нулю с подтяжкой к единице

    GPIO.output(motor1, 0)
    GPIO.output(motor2, 1)
    print("Вращение в право -> ")

    time.sleep(2)
    #GPIO.wait_for_edge(irStop, GPIO.FALLING) # Добавляем детектирование события - нажатие кнопки

    GPIO.output(motor1, 1)
    GPIO.output(motor2, 1)
    print("Стоп -> ")

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
    GPIO.cleanup()                              # Возвращаем пины в исходное состояние
    print("End of program")                     # Информируем о завершении работы программы
