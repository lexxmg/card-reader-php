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

    <link rel="stylesheet" href="/css/normalize.css">
    <link rel="stylesheet" href="/css/master.css">
    <link rel="stylesheet" href="/css/header.css">
    <link rel="stylesheet" href="/css/menu.css">
    <link rel="stylesheet" href="/css/card.css">
    <link rel="stylesheet" href="/css/settings.css">

    <script src="/js/script.js" defer></script>
  </head>

  <body>
    <div id="ph" class="placeholder">
        <!-- <img src="/img/placeholder.gif" alt="placeholder" class="placeholder__img"> -->
        <p class="placeholder__text">Подождите...</p>
    </div>

    <div class="header clearfix">
        <h1 class="header__title"><?=getTitle($menu)?></h1>

        <div class="header__nav">
            <?php showMenu($menu, 'sort', SORT_ASC, 'menu')?>
        </div>
    </div>

    <div class="fixed-container">
