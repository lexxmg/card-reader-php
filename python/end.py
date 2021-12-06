import RPi.GPIO as GPIO                 # Импортируем библиотеку по работе с GPIO
import time                             # Импортируем класс для работы со временем
import sys, traceback                   # Импортируем библиотеки для обработки исключений

try:
    # === Инициализация пинов ===
    GPIO.setmode(GPIO.BCM)

    irStop=12 # pin 32
    pinPWM=16 # pin 36
    motor1=20 # pin 38
    motor2=21 # pin 40

    GPIO.setup(pinPWM, GPIO.OUT) # Устанавливаем pinPWM в режим OUTPUT
    GPIO.setup([motor1, motor2], GPIO.OUT, initial=0)     # Пины со светодиодом в режим OUTPUT, выключены
    GPIO.setup(irStop, GPIO.IN, pull_up_down=GPIO.PUD_UP)   # Кнопку в режим INPUT, к нулю с подтяжкой к единице

    pwm = GPIO.PWM(pinPWM, 1000)   # Создаем ШИМ-объект для пина pinPWM с частотой 1000 Гц

    pwm.start(100)               # Запускаем ШИМ на пине со скважностью 50% (0-100%)
                                 # Можно использовать данные типа float - 49.5, 2.45

    #pwm.ChangeFrequency(1000)   # Изменяем частоту до 1000 Гц (также можно float)


    GPIO.output(motor1, 0)
    GPIO.output(motor2, 1)
    print("Вращение в право -> ")

    time.sleep(0.30)
    pwm.ChangeDutyCycle(65)      # Изменяем скважность до 50%
    GPIO.wait_for_edge(irStop, GPIO.RISING) # Добавляем детектирование события - нажатие кнопки
    #time.sleep(0.208625)

    GPIO.output(motor1, 1)
    GPIO.output(motor2, 1)

    print("Стоп -> ")

    time.sleep(.2)

    GPIO.output(motor1, 0)
    GPIO.output(motor2, 1)
    print("Вращение в право -> ")

    time.sleep(0.2)
    pwm.ChangeDutyCycle(65)      # Изменяем скважность до 50%
    GPIO.wait_for_edge(irStop, GPIO.RISING) # Добавляем детектирование события - нажатие кнопки
    #time.sleep(0.208625)

    GPIO.output(motor1, 1)
    GPIO.output(motor2, 1)
    time.sleep(0.1)
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
    pwm.stop()                                  # Останавливаем ШИМ
    print("End of program")                     # Информируем о завершении работы программы
