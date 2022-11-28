<?php
use yii\bootstrap5\LinkPager;
use yii\helpers\Html;
?>
<h1>Authors&CountOfBooks</h1>
<pre>
    <?print_r($countOfBooks)?>
</pre>
<ul>
<?php foreach ($countOfBooks as $cnt): ?>
    <li>
        <?= Html::encode("{$cnt->author->full_name} - {$cnt->cnt}") ?>
    </li>
<?php endforeach; ?>
</ul>
<?= LinkPager::widget(['pagination' => $pagination]) ?>
