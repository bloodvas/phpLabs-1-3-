<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\widgets\Alert;
echo Alert::widget();   
?>
<div class="wrapper">
    <div class="form">
        <h5>Отзыв о ресторане</h5>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'name')->label('Ваше имя:') ?>
                <?= $form->field($model, 'email')->textInput(['type'=> 'email'])->label('Ваш e-mail:'); ?>
                <?= $form->field($model, 'yOld')->textInput(['type'=> 'number'])->label('Ваш возраст:'); ?>
                <?= $form->field($model, 'dateCheck')->textInput(['type'=> 'date'])->label('Дата посещения:'); ?>
                <?= $form->field($model, 'favFood')->dropDownList(['Русская'=>'Русская', 'Грузинская'=>'Грузинская', 'Азиатская'=> 'Азиатская'])->label('Любимая кухня:'); ?>
                <?= $form->field($model,'radioFeedback')->radioList(items: ['Рекомендую'=>'Да', 'Не рекомендую'=>'Нет'])->label('Порекомендуете нас друзьям?');?>
                <?= $form->field($model, 'feedback')->textarea()->label('Текст отзыва:'); ?>
                <br>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>
    </div>
    <div class="result-form">
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