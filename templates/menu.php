<ul class="<?=$className?>">
    <?php foreach (arraySort($array, $key, $sort) as $key => $value): ?>
        <li>
          <a class="<?=isCurrentUrl($value['path']) ? 'active' : ''?>"
             href="<?=$value['path']?>"
          >
            <?=$value['title']?>
          </a>
        </li>
    <?php endforeach; ?>
</ul>
