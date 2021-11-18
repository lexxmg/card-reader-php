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
