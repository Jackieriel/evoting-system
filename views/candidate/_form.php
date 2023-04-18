<?php

use app\models\Position;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Candidate $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="candidate-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data'],]); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'bio')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'imageFile')->fileInput(['id' => 'image-file-input']) ?>

    <img id="image-preview" style="display: none;" class="img-thumbnail img-upload-preview" />

    <!-- Fetch data to form -->
    <?= $form->field($model, 'position_id')->dropDownList(
        ArrayHelper::map(Position::find()->all(), 'id', 'name'),
        ['prompt' => 'Select Position']
    ) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>