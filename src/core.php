<?php

require $_SERVER['DOCUMENT_ROOT'] . '/src/main_menu.php';
require $_SERVER['DOCUMENT_ROOT'] . '/src/functions.php';

$pathResult = $_SERVER['DOCUMENT_ROOT'] . '/upload/result.txt';

$file = file($pathResult);

if ( isset($_GET['read']) ) {
    shell_exec($_SERVER['DOCUMENT_ROOT'] . '/bash/reade.sh');

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
    $count = getStorage()['count'];

    if ($rotate === 'right') {
        setStorage($arr = ['count' => $count + 1]);

        if ($count >= 4) {
            setStorage($arr = ['count' => 0]);
        }

        echo shell_exec($_SERVER['DOCUMENT_ROOT'] . '/bash/right.sh');
    }

    if ($rotate === 'left') {
        setStorage($arr = ['count' => $count - 1]);

        if ($count <= -4) {
            setStorage($arr = ['count' => 0]);
        }

        shell_exec('python ' . $_SERVER['DOCUMENT_ROOT'] . '/python/left.py');
    }
}
