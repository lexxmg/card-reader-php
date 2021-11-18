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
 </main>    
