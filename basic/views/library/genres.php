<?php
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
?>
<h1>Genres</h1>
<ul>
<?php foreach ($genres as $genre): ?>
    <li>
        <?= Html::encode("{$genre->id} ({$genre->genrename})") ?>
    </li>
<?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
