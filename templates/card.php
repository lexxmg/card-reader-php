<main class="card">
    <h2 class="card__title">Програмирование карт</h2>

    <div class="card__inner clearfix">
        <div class="card__img-container">
            <img class="card__img" src="/upload/result.png" alt="карточка">
        </div>

        <?php if ( file_exists($pathResult) ): ?>
            <a href="/?delete=yes" class="card__link">Удалить</a>
        <?php else: ?>
            <a href="/?read=yes" class="card__link">Распознать</a>
        <?php endif; ?>

        <a href="/?cut=yes" class="card__link">Обрезать</a>
    </div>

    <span class="card__number"><?=substr($file[0], 0, 10)?></span>

    <img src="../img/card.png" alt="" class="card__img-full">
 </main>
