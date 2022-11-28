<?php
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use app\widgets\Alert;
use yii\bootstrap5\LinkPager;
echo Alert::widget();   

?>
</pre>
<div class="wrapper">
    <div class="form">
        <h5>Добавление автора</h5>
        <pre><?print_r($genres)?></pre>
            <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'id')->label('Идентификатор:'); ?>
                <?= $form->field($model, 'name')->label('Фио атора:'); ?>
                <?= $form->field($model, 'birthday')->textInput(['type'=> 'date'])->label('Родился:'); ?>
                <?= $form->field($model, 'death')->textInput(['type'=> 'date'])->label('Умер:'); ?>
                <?= $form->field($model, 'genreId')->dropDownList(ArrayHelper::map($genres,'id','genrename'))->label('Жанр:'); ?>
                <br>
                <div class="form-group">
                    <?= Html::submitButton('Отправить', ['class' => 'btn btn-success']) ?>
                </div>
            <?php ActiveForm::end(); ?>
    </div>
    <div class="result-form">
        <p>Авторы:</p>
            <?php if (isset($authors)) {?>
                <ul>
                <?php foreach ($authors as $author): ?>
                    <li>
                        <?= Html::encode("{$author->id} {$author->full_name}      {$author->birth_date}      {$author->death_date}") ?>
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