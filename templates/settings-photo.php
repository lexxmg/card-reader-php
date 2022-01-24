<?php
$psm = [  //Page segmentation modes:
  ['value' => 0, 'text' => 'Orientation and script detection (OSD) only.'],
  ['value' => 1, 'text' => 'Automatic page segmentation with OSD.'],
  ['value' => 2, 'text' => 'Automatic page segmentation, but no OSD, or OCR. (not implemented)'],
  ['value' => 3, 'text' => 'Fully automatic page segmentation, but no OSD. (Default)'],
  ['value' => 4, 'text' => 'Assume a single column of text of variable sizes.'],
  ['value' => 5, 'text' => 'Assume a single uniform block of vertically aligned text.'],
  ['value' => 6, 'text' => 'Assume a single uniform block of text.'],
  ['value' => 7, 'text' => 'Treat the image as a single text line.'],
  ['value' => 8, 'text' => 'Treat the image as a single word.'],
  ['value' => 9, 'text' => 'Treat the image as a single word in a circle.'],
  ['value' => 10, 'text' => 'Treat the image as a single character.'],
  ['value' => 11, 'text' => 'Sparse text. Find as much text as possible in no particular order.'],
  ['value' => 12, 'text' => 'Sparse text with OSD.'],
  ['value' => 13, 'text' => 'Raw line. Treat the image as a single text line, bypassing hacks that are Tesseract-specific.']
];

if (isset($_POST['settingsPhotoSubmit'])) {
    $storage['offsetLeft'] = $_POST['x'];
    $storage['offsetTop'] = $_POST['y'];
    $storage['width'] = $_POST['width'];
    $storage['height'] = $_POST['height'];
    $storage['psm'] = $_POST['select'];

    setStorage($storage);
}
?>

<script src="/js/photo-settings.js" defer></script>

<h2 class="settings-photo-title">Редактирование обрезки фото</h2>

<form class="settings-photo__form settings-photo-form" action="" method="post">
    <div class="settings-photo-form__inner">
        <label class="settings-photo-form__label">Смещение фото Х:
            <input class="settings-photo-form__input" type="number" name="x" value="<?=$storage['offsetLeft']?>">
        </label>

        <label class="settings-photo-form__label">Смещение фото Y:
            <input class="settings-photo-form__input" type="number" name="y" value="<?=$storage['offsetTop']?>">
        </label>
    </div>

    <div class="settings-photo-form__inner">
        <label class="settings-photo-form__label">Ширина рамки:
            <input class="settings-photo-form__input" type="number" name="width" value="<?=$storage['width']?>">
        </label>

        <label class="settings-photo-form__label">Высота рамки:
            <input class="settings-photo-form__input" type="number" name="height" value="<?=$storage['height']?>">
        </label>
    </div>

    <div class="settings-photo-form__inner">
        <label class="settings-photo-form__label">Настройки распознования номера:
            <select class="settings-photo-form__sellect" name="select">
                <?php foreach ($psm as $key => $value): ?>
                    <option class="settings-photo-form__option"
                        value="<?=$value['value']?>"
                        <?php if ($value['value'] == $storage['psm']): ?>
                            selected="true"
                        <?php endif; ?>
                        ><?=$value['text']?>
                    </option>
                <?php endforeach; ?>
            </select>
        </label>
    </div>

    <button class="settings-photo-form__btn" name="settingsPhotoSubmit">Применить</button>
</form>

<div class="settings-photo-img-container settings-photo-img-container-js">
    <img class="settings-photo-img-container__img" src="/upload/test.jpg?nocach=<?=time()?>" alt="карта-пропуск">

    <div class="settings-photo-img-container__border"></div>
</div>

<a href="?photo=yes">Сделать фото</a>
