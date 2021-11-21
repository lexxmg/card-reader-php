
<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/header.php'?>
    <h2>Ручное управление</h2>

    <a href="?init=on">Установить 0, создать каталоги</a>

    <p><?php var_dump( getStorage() )?></p>
    <br>
    <hr>

    <a href="?rotate=left">В лево</a>
    <a href="?rotate=right">В право</a>
<?php require $_SERVER['DOCUMENT_ROOT'] . '/templates/footer.php'?>
