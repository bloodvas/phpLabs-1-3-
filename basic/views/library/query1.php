<?php
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
?>
<h1>Books&Author&Genre</h1>
<ul>
<?php foreach ($books as $book): ?>
    <li>
        <?= Html::encode("{$book->booksname} - {$book->author->full_name} - {$book->genre->genrename}") ?>
    </li>
<?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
