<?php
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
?>
<h1>Books</h1>
<ul>
<?php foreach ($books as $book): ?>
    <li>
        <?= Html::encode("{$book->id} ({$book->booksname})") ?>:
        <?= $book->description ?>
    </li>
<?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
