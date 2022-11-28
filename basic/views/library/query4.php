<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Alert;
echo Alert::widget();   


?></pre>
<div class="wrapper">
    <div class="form">
        <h5>Поиск книг</h5>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'word')->label('Слово для поиска книг:'); ?>
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
                <?php foreach ($books as $label): ?>
                    <li>
                        <?= Html::encode("{$label->booksname}") ?>
                    </li>
                <?php endforeach; ?>
            </ul>
            <?php }?>
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