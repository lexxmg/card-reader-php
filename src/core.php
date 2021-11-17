<?php

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
