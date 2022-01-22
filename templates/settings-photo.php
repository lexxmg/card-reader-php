<script src="/js/photo-settings.js" defer></script>

<h2 class="settings-photo-title">Редактирование обрезки фото</h2>

<form class="settings-photo__form settings-photo-form" action="" method="post">
    <div class="settings-photo-form__inner">
        <label class="settings-photo-form__label">Смещение фото Х:
            <input class="settings-photo-form__input" type="number" name="x">
        </label>

        <label class="settings-photo-form__label">Смещение фото Y:
            <input class="settings-photo-form__input" type="number" name="y">
        </label>
    </div>

    <div class="settings-photo-form__inner">
        <label class="settings-photo-form__label">Ширина рамки:
            <input class="settings-photo-form__input" type="number" name="width">
        </label>

        <label class="settings-photo-form__label">Высота рамки:
            <input class="settings-photo-form__input" type="number" name="height">
        </label>
    </div>

    <div class="settings-photo-form__inner">
        <label class="settings-photo-form__label">Настройки распознования номера:
            <select class="settings-photo-form__sellect" name="select"></select>
        </label>
    </div>

    <button class="settings-photo-form__btn" name="settingsPhotoSubmit">Применить</button>
</form>

<div class="settings-photo-img-container settings-photo-img-container-js">
    <img class="settings-photo-img-container__img" src="/upload/test.jpg?nocach=<?=time()?>" alt="карта-пропуск">

    <div class="settings-photo-img-container__border"></div>
</div>

<a href="?photo=yes">Сделать фото</a>
