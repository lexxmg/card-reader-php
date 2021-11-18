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
