<?php
    $allCard = htmlspecialchars($_POST['count'] ?? '');
    $addCard = htmlspecialchars($_POST['addCard'] ?? '');

    if ( isset($_POST['addCardSubmit']) ) {
        $storage['count'] = $allCard + $addCard;

        setStorage($storage);
    }
?>

<h2>Ручное управление</h2>

<a href="?init=on">Установить 0, создать каталоги</a>

<p><?php var_dump( getStorage() )?></p>
<br>
<hr>

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

<a href="?rotate=left">В лево</a>
<a href="?rotate=right">В право</a>
<br>
<a href="?card_read=read">Считать карту</a>
<br>
<a href="?card_read=test">Проверить</a>
<br>
<a href="?card_read=end">Готово</a>
<br>
<a href="?photo=yes">Сделать фото</a>
