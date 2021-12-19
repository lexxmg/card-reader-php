<?php

require $_SERVER['DOCUMENT_ROOT'] . '/src/main_menu.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';

$pathResult = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.txt';
$pathImage = $_SERVER['DOCUMENT_ROOT'] . '/img/card.png';
$pathCutImage = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.png';

//var_dump(imagecreatefrompng($_SERVER['DOCUMENT_ROOT'] . '/img/card.png'));

$storage = getStorage();
$file = file($pathResult);
//var_dump($file[0]);

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
    image_crop($pathImage, $pathCutImage, 2615, 1638, 600, 100);

    header('Location: /');
    exit();
}

if ( isset($_GET['delete']) ) {
    unlink($pathResult);

    header('Location: /');
    exit();
}

if ( isset($_GET['photo']) ) {
    shell_exec("sudo libcamera-jpeg -o $path/upload/test.jpg");

    //header('Location: /');
    //exit();
}

if ( isset($_GET['init']) ) {
    $pathURI = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

    $storage = [
        'step' => 0,
        'currentCount' => 0,
        'count' => 0
    ];

    var_dump( createDir('upload') );
    var_dump( createDir('storage') );
    var_dump( setStorage($storage) );

    header("Location: $pathURI");
    exit();
}

if ( isset($_GET['rotate']) ) {
    $rotate = $_GET['rotate'];

    if ($rotate === 'right') {
        $storage['step'] = $storage['step'] + 1;

        setStorage($storage);

        if ($storage['step'] > 3) {
            $storage['step'] = 0;
            $storage['count'] = $storage['count'] - 1;
            $storage['currentCount'] = $storage['currentCount'] - 1;

            setStorage($storage);
        }

        var_dump( rotateMotor('right') );
    }

    if ($rotate === 'left') {
        $storage['step'] = $storage['step'] - 1;

        setStorage($storage);

        if ($storage['step'] < -3) {
            $storage['step'] = 0;
            setStorage($storage);
        }

        var_dump( rotateMotor('left') );
    }
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
    }
}
