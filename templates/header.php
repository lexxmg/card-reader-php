<?php
    require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Пропуска</title>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/card.css">

    <link rel="stylesheet" href="lib/slick/slick-theme.css">
    <link rel="stylesheet" href="lib/slick/slick.css">

    <script src="lib/jQuery/jquery-3.5.1.min.js" defer></script>
    <script src="lib/slick/slick.min.js" defer></script>
    <script src="js/script.js" defer></script>
  </head>

  <body>
    <div class="fixed-container">
        <main class="card">
            <h1 class="card__title">Програмирование карт</h1>

            <div class="card__inner clearfix">
                <div class="card__img-container">
                    <img class="card__img" src="/img/num.png" alt="карточка">
                </div>

                <?php if ( file_exists($pathResult) ): ?>
                    <a href="/?delete=yes" class="card__link">Удалить</a>
                <?php else: ?>
                    <a href="/?read=yes" class="card__link">Распознать</a>
                <?php endif; ?>
            </div>

            <span class="card__number"><?=substr($file[2], 0, 10)?></span>
