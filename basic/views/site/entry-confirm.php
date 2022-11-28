<?php
use yii\helpers\Html;
?>
<p>Вы ввели следующую информацию:</p>
<ul>
    <li><label>Ваше имя</label>: <?= Html::encode($model->name) ?></li>
    <li><label>Ваш e-mail</label>: <?= Html::encode($model->email) ?></li>
    <li><label>Ваш возраст</label>: <?= Html::encode($model->yOld) ?></li>
    <li><label>Дата посещения</label>: <?= Html::encode($model->dateCheck) ?></li>
    <li><label>Любимая кухня</label>: <?= Html::encode($model->favFood) ?></li>
    <li><label>Порекомендуете нас друзьям?</label>: <?= Html::encode($model->radioFeedback) ?></li>
    <li><label>Текст отзыва</label>: <?= Html::encode($model->feedback) ?></li>
</ul>


