<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Alert;
use yii\bootstrap5\LinkPager;
echo Alert::widget();   


?></pre>
<div class="wrapper">
    <div class="form">
        <h5>Поиск книг в диапозоне</h5>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'firstDate')->textInput(['type'=> 'date'])->label('Первая дата:'); ?>
                <?= $form->field($model, 'secondDate')->textInput(['type'=> 'date'])->label('Вторая дата:'); ?>
                <br>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>
    </div>
    <div class="result-form">
        <p>Книги:</p>
            <?php if (isset($books)) {?>
                <ul>
                <?php foreach ($books as $book): ?>
                    <li>
                    <?= Html::encode("{$book->booksname} - {$book->release_date}") ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php }?>
            <?= LinkPager::widget(['pagination' => $pagination]) ?>
    </div>
</div>

<style>
    .wrapper{
        display: flex;
        justify-content: space-between;
    }
    .form, .result-form{
        width: 40%;
    }
</style>