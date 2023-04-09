<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Voter $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="voter-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="mb-3">
        <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="mb-3">
    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>

    <?php ActiveForm::end(); ?>

</div>