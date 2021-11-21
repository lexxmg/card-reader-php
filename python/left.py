import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    pinLED1=14
    pinLED2=15

    GPIO.setup([pinLED1, pinLED2], GPIO.OUT, initial=0)     # Пины со светодиодом в режим OUTPUT, выключены

    time.sleep(5)
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
    print("CleanUp")                            # Информируем сбросе пинов
    GPIO.cleanup()                              # Возвращаем пины в исходное состояние
    print("End of program")                     # Информируем о завершении работы программы
