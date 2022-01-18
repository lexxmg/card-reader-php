<?php
    $allCard = htmlspecialchars($_POST['count'] ?? '');
    $addCard = htmlspecialchars($_POST['addCard'] ?? '');

    if ( isset($_POST['addCardSubmit']) ) {
        $storage['count'] = $allCard + $addCard;

        setStorage($storage);
    }

    if ( isset($_GET['rotate']) ) {
        $rotate = $_GET['rotate'];

        if ($rotate === 'right') {
            var_dump( rotateMotor('right') );
            getPhoto();
        }

        if ($rotate === 'left') {
            var_dump( rotateMotor('left') );
            getPhoto();
        }

        if ($rotate === 'zerro') {
            var_dump( rotateMotor('zerro') );
            getPhoto();
        }
    }
?>

<h2 class="settings-title">Ручное управление</h2>

<a href="?init=on">Установить 0, создать каталоги</a>

<p><?php var_dump( getStorage() )?></p>
<br>
<hr>

<h2 class="settings-title">Добавление карт</h2>

<form class="settings__form settings-form" method="post">
    <label class="settings-form__label">Всего карт:
        <input
            class="settings-form__input"
            type="text" name="count"
            value="<?=$storage['count']?>"
        >
    </label>

    <label class="settings-form__label">Добавить:
        <input
            class="settings-form__input"
            type="text" name="addCard"
            value="0"
        >
    </label>

    <button class="settings-form__btn" name="addCardSubmit">Применить</button>
</form>

<hr>

<form class="settings__form-task settings-form-task" method="post">
    <label class="settings-form-task__label">Текущее задание:
        <input
            class="settings-form-task__input"
            type="text" name="currentTaskCount"
            value="<?=$storage['currentCount']?>"
        >
    </label>

    <button class="settings-form-task__btn" name="currentTask">Применить</button>
</form>

<hr>

<h2 class="settings-title">Управление мотором</h2>

<table class="settings-table">
    <tr class="settings-table__row">
        <td class="settings-table__column settings-table__column--left">
            <a class="settings-table__link settings-table__link--left"
                onclick="startPlaceholder(event); return false"
                href="?rotate=left">В лево
            </a>
        </td>

        <td class="settings-table__column settings-table__column--centre">
            <a class="settings-table__link settings-table__link--centre"
                onclick="startPlaceholder(event); return false"
                href="?rotate=zerro">В лево до ИК-стоп
            </a>
        </td>

        <td class="settings-table__column settings-table__column--right">
            <a class="settings-table__link settings-table__link--right"
            onclick="startPlaceholder(event); return false"
            href="?rotate=right">В право
            </a>
        </td>
    </tr>
</table>

<div class="settings-img-container">
    <img class="settings-img-container__img" src="/upload/test.jpg?nocach=<?=time()?>" alt="карта-пропуск">
</div>

<a href="?photo=yes">Сделать фото</a>
