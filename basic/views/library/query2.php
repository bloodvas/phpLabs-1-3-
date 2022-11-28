<?php
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
?>
<h1>Books of 20th century</h1>
<ul>
<?php foreach ($books as $book): ?>
    <li>
        <?= Html::encode("{$book->booksname} - {$book->release_date}") ?>
    </li>
<?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
