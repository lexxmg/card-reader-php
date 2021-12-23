<?php

/**
* Обрезка картинки
* image_crop('image.png', 'new_image.png', 0, 0, 200, 200);
*/
function image_create($image_path)
{
    $ext = pathinfo($image_path, PATHINFO_EXTENSION);
    switch($ext) {
        case 'gif':
            $im = imagecreatefromgif($image_path);
            break;
        case 'jpg':
            $im = imagecreatefromjpeg($image_path);
            break;
        case 'png':
            $im = imagecreatefrompng($image_path);
            break;
        default:
            throw new Exception('Неверный формат файла');
    }

    unset($ext);
    return $im;
}

function image_crop($image_source, $save_as, $x, $y, $width, $height)
{
    // Проверка на наличие изображений
    if (!file_exists($image_source)) { throw new Exception('Изображение '.$image_source.' не найдено'); }

    $image = image_create($image_source);
    $new_image = imagecreatetruecolor($width, $height);

    // сохранение прозрачности (для PNG и GIF)
    imagealphablending($new_image, false);
    imagesavealpha($new_image, true);

    imagecopy($new_image, $image, 0, 0, $x, $y, $width, $height);

    // сохранение картинки
    imagepng($new_image, $save_as);

    // освобождение памяти
    imagedestroy($image);
    imagedestroy($new_image);
}

/**
* Сортировка массива
* arraySort($array, 'sort_key', SORT_ASC) по возрастанию
* arraySort($array, 'sort_key', SORT_DESC) по убыванию
*/
function arraySort(array $array, $key = 'sort', $sort = SORT_ASC): array
{
    array_multisort(array_column($array, $key), $sort, $array);

    return $array;
}

/**
* Вывод меню
* showMenu($menu, 'title', SORT_DESC, 'main-menu bottom')
*/
function showMenu(array $array, string $key, $sort, $className = '')
{
    require($_SERVER['DOCUMENT_ROOT'] . '/templates/menu.php');
}



/**
* Получить заголовок
*/
function getTitle(array $menu): string
{
    $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    foreach ($menu as $key => $value) {
        if ($value['path'] === $path) {
          return $value['title'];
        }
    }

    return 'Страница не найдена';
}

/**
* Если путь существует
* isCurrentUrl('/route/directory/') true
*/
function isCurrentUrl(string $url): bool
{
    return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) === $url;
}

/**
* Создает каталог
* Возвращает путь до созданного каталога
* createDir('upload')
*/
function createDir(string $dirName)
{
    $path = $_SERVER['DOCUMENT_ROOT'] . "/$dirName";

    if ( is_dir($path) ) {
        return $path;
    } else {
        return mkdir($path) ? $path : false;
    }
}

/**
* Создаёт запись в файле, принимает масссив
*
*/
function setStorage(array $array): bool
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/storage/storage.json';
    return file_put_contents( $path, json_encode($array) ) ? true : false;
}

/**
* Читает из файла JSON, возвращает масссив или false
* getStorage($_SERVER['DOCUMENT_ROOT'] . '/storage')
*/
function getStorage()
{
    if ( is_file($_SERVER['DOCUMENT_ROOT'] . '/storage/storage.json') ) {
        $pathFile = $_SERVER['DOCUMENT_ROOT'] . '/storage/storage.json';
    } else {
        return false;
    }

    return json_decode(file_get_contents($pathFile), true);
}

/**
* Управление GPIO
* rotateMotor('right') Вращение в право
* rotateMotor('left') Вращение в лево
*/
function rotateMotor(string $direction = 'right'): string
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/python';

    if ($direction === 'right') {
        return shell_exec("sudo python $path/right.py");
    }

    if ($direction === 'left') {
        return shell_exec("sudo python $path/left.py");
    }

    if ($direction === 'end') {
        return shell_exec("sudo python $path/end.py");
    }

    if ($direction === 'read') {
        return shell_exec("sudo python $path/read.py");
    }

    if ($direction === 'test') {
        return shell_exec("sudo python $path/test.py");
    }
}

/**
* Склонение
* declOfNum($cards, ['1карта', '3карты', '5карт'])
*/
function declOfNum($number, $titles = [])
{
    $cases = [2, 0, 1, 1, 1, 2];
    return $titles[ ($number % 100 > 4 && $number % 100 < 20) ? 2 : $cases[ ($number % 10 < 5) ? $number % 10 : 5 ] ];
}

/**
* Сделать фото
* createFoto()
*/
function createFoto()
{
    $path = $_SERVER['DOCUMENT_ROOT'] . '/upload/test.jpg';
    $cutImage = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.jpg';

    shell_exec("sudo libcamera-still -n -o $path --width 1920 --height 1080 --shutter 20000 --immediate");

    image_crop($path, $cutImage, 1255, 530, 600, 100);

    shell_exec("sudo tesseract -l rus  --dpi 300 --psm 11 $cutImage /var/www/html/upload/result;");
}
