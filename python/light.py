import config
import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    LED = config.LED

    GPIO.setup(LED, GPIO.OUT, initial=0)     # Пины со светодиодом в режим OUTPUT, выключены

    if (sys.argv[1] == 'on'):
        GPIO.output(LED, 1)

    if (sys.argv[1] == 'off'):
        GPIO.output(LED, 0)

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
    #pwm.stop()                                  # Останавливаем ШИМ
    print("End of program")                     # Информируем о завершении работы программы
