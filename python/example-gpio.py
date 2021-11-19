import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    pinLED1=14                                  # Пин светодиода
    pinLED2=15                                  # Пин светодиода
    pinBtn=25                                   # Пин кнопки замыкается на ноль и подтянут к лог. единице
    GPIO.setup([pinLED1, pinLED2], GPIO.OUT, initial=0)     # Пины со светодиодом в режим OUTPUT, выключены
    GPIO.setup(pinBtn, GPIO.IN, pull_up_down=GPIO.PUD_UP)   # Кнопку в режим INPUT, к нулю с подтяжкой к единице

    GPIO.add_event_detect(pinBtn, GPIO.FALLING) # Добавляем детектирование события - нажатие кнопки

    # Делаем произвольные манипуляции - мигаем первым светодиодом
    for i in range(0,10): # Если во время этого цикла (мигания светодиодом) нажать кнопку, то после этого загорится второй светодиод
        GPIO.output(pinLED1, 1)
        time.sleep(0.2)
        GPIO.output(pinLED1, 0)
        time.sleep(0.2)

    if GPIO.event_detected(pinBtn):             # Если за время цикла мигания было нажатие, то загорится 2 светодиод
        GPIO.output(pinLED2, 1)
        GPIO.wait_for_edge(pinBtn, GPIO.FALLING, timeout=5000) # Выход по нажатию кнопки или через 5 секунд

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
