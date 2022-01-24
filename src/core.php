<?php

require $_SERVER['DOCUMENT_ROOT'] . '/src/main_menu.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';

$pathResult = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.txt';
$pathImage = $_SERVER['DOCUMENT_ROOT'] . '/upload/test.jpg';
$pathCutImage = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.jpg';

//var_dump(imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/img/card.png'));

$storage = getStorage();
$file = file($pathResult);
//var_dump(substr($file[0], 1, 10));

if ( isset($_POST['currentTask']) ) {
  $currentCount = $_POST['currentTaskCount'];

  $storage['currentCount'] = $currentCount;

  setStorage($storage);
}

if ( isset($_GET['read']) ) {
    shell_exec($_SERVER['DOCUMENT_ROOT'] . '/bash/reade.sh');

    header('Location: /');
    exit();
}

if ( isset($_GET['cut']) ) {
    image_crop($pathImage, $pathCutImage, 1595, 150, 600, 100);

    header('Location: /');
    exit();
}

if ( isset($_GET['delete']) ) {
    unlink($pathResult);

    header('Location: /');
    exit();
}

if ( isset($_GET['photo']) ) {
    //$path = $_SERVER['DOCUMENT_ROOT'];

    //shell_exec("sudo libcamera-still -n -o $path/upload/test.jpg --width 1920 --height 1080 --shutter 20000 --immediate");

    createPhoto($storage['offsetLeft'], $storage['offsetTop'], $storage['width'], $storage['height'], $storage['psm']);

    header('Location: /');
    exit();
}

if ( isset($_GET['init']) ) {
    $pathURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $storage = [
        'step' => 0,
        'currentCount' => 0,
        'count' => 0, //57
        'offsetLeft' => 1115,
        'offsetTop' => 403,
        'width' => 650,
        'height' => 110,
        'psm' => 8
    ];

    // var_dump($storage);
    // var_dump( createDir('upload') );
    // var_dump( createDir('storage') );
    var_dump( setStorage($storage) );

    header("Location: $pathURI");
    exit();
}

if ( isset($_GET['card_read']) ) {
    $cardReaed = $_GET['card_read'];

    if ($cardReaed === 'read' && $storage['step'] === 0) {
        rotateMotor('read');
        $storage['step'] = $storage['step'] + 2;

        setStorage($storage);
    }

    if ($cardReaed === 'test' && $storage['step'] === 2) {
        rotateMotor('test');
    }

    if ($cardReaed === 'end' && $storage['step'] === 2) {
        rotateMotor('end');

        $storage['step'] = 0;
        $storage['count'] = $storage['count'] - 1;
        $storage['currentCount'] = $storage['currentCount'] - 1;
        setStorage($storage);
        createPhoto($storage['offsetLeft'], $storage['offsetTop'], $storage['width'], $storage['height'], $storage['psm']);
        header('Location: /');
        exit();
    }
}
