<!-- <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


/** @var yii\web\View $this */
?>

<?php $form = ActiveForm::begin([
   'action' => ['vote/vote'],
]); ?>

<?php foreach ($positions as $position) : ?>
  <h3><?= Html::encode($position->name) ?></h3>
  <p>Select your preferred candidate:</p>
  <?= $form->field($model, "candidates[{$position->id}]")->radioList($position->getCandidatesList()) ?>
<?php endforeach; ?>

<div class="form-group">
  <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?>
</div>

<?php ActiveForm::end(); ?> -->