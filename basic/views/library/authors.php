<?php
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
?>
<h1>Authors</h1>
<ul>
<?php foreach ($authors as $author): ?>
    <li>
        <?= Html::encode("{$author->id} ({$author->full_name})") ?>:
        <?= $author->birth_date ?>
        <?= $author->death_date ?>
    </li>
<?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
