<?php

require $_SERVER['DOCUMENT_ROOT'] . '/src/main_menu.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';

$pathResult = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.txt';
$pathImage = $_SERVER['DOCUMENT_ROOT'] . '/img/card.png';
$pathCutImage = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.png';

//var_dump(imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/img/card.png'));


$file = file($pathResult);
//var_dump($file[0]);

if ( isset($_GET['read']) ) {
    shell_exec($_SERVER['DOCUMENT_ROOT'] . '/bash/reade.sh');

    header('Location: /');
    exit();
}

if ( isset($_GET['cut']) ) {
    image_crop($pathImage, $pathCutImage, 2615, 1638, 600, 100);

    header('Location: /');
    exit();
}

if ( isset($_GET['delete']) ) {
    unlink($pathResult);

    header('Location: /');
    exit();
}

if ( isset($_GET['init']) ) {
    var_dump( createDir('upload') );
    var_dump( createDir('storage') );
    var_dump( setStorage($arr = ['count' => 0]) );
}

if ( isset($_GET['rotate']) ) {
    $rotate = $_GET['rotate'];
    $storage = getStorage();

    if ($rotate === 'right') {
        $storage['step'] = $storage['step'] + 1;

        setStorage($storage);

        if ($storage['step'] > 4) {
            $storage['step'] = 0;
            $storage['count'] = $storage['count'] - 1;
            setStorage($storage);
        }

        var_dump( shell_exec('sudo python ' . $_SERVER['DOCUMENT_ROOT'] . '/python/right.py') );
    }

    if ($rotate === 'left') {
        $storage['step'] = $storage['step'] - 1;

        setStorage($storage);

        if ($storage['step'] < -4) {
            $storage['step'] = 0;
            setStorage($storage);
        }

        var_dump( shell_exec('sudo python ' . $_SERVER['DOCUMENT_ROOT'] . '/python/left.py') );
    }
}
