<main class="card">
    <h2 class="card__title">Програмирование карт</h2>

    <div class="card__info card-info clearfix">
      <div class="card-info__count clearfix <?=($storage['count'] <= 10) ? 'card--warning' : ''?>">
        <span class="card-info__label-count">Всего карт:</span>
        <span class="card-info__count-cards"><?=$storage['count']?></span>
      </div>

      <div class="card__current-task clearfix">
          <?php if ($storage['currentCount'] <= 0): ?>
              <form class="card-info__form" method="post">
                <label class="card-info__label">Текущие задание:
                  <input class="card-info__input" type="number" name="currentTaskCount" value="<?=$storage['currentCount'] ?? ''?>">
                </label>

                <button class="card-info__submit" name="currentTask">Изменить</button>
              </form>
          <?php else: ?>
              <span class="card__text-task">Осталось сделать:</span>
              <span class="card__count-task"><?=$storage['currentCount'] ?? ''?></span>
              <span class="card__text-task"><?=declOfNum($storage['currentCount'] ?? 0, ['карту', 'карты', 'карт'])?></span>
          <?php endif; ?>

      </div>
    </div>

    <div class="card__inner clearfix">
        <div class="card__img-container">
            <img class="card__img" src="/upload/result.jpg?nocach=<?=time()?>" alt="карточка">
        </div>

        <div class="card__btn-container">
          <?php if ( file_exists($pathResult) ): ?>
              <a href="/?delete=yes" class="card__link card-btn">Удалить</a>
          <?php else: ?>
              <a href="/?read=yes" class="card__link card-btn">Распознать</a>
          <?php endif; ?>

          <a href="/?cut=yes" class="card__link card-btn">Обрезать</a>

          <a href="/?photo=yes" class="card__link card-btn">Сделать фото</a>
        </div>

        <div class="card__btn-container">
          <?php if ($storage['step'] === 0): ?>
            <a class="card__link card-btn" href="?card_read=read">Считать карту</a>
          <?php else: ?>
            <a class="card__link card-btn" href="?card_read=test">Проверить</a>
            <a class="card__link card-btn" href="?card_read=end">Готово</a>
          <?php endif; ?>
        </div>
    </div>

    <span class="card__number"><?=substr($file[0], 0, 10)?></span>

    <img src="/upload/test.jpg?nocach=<?=time()?>" alt="карта-пропуск" class="card__img-full">
 </main>
