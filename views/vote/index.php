<?php

use app\models\Candidate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Vote';
$this->params['breadcrumbs'][] = $this->title;
?>


<?php $form = \yii\widgets\ActiveForm::begin([
    'action' => ['vote'],
]); ?>
<?php foreach ($positions as $position) : ?>
    <h2><?= \yii\helpers\Html::encode($position->name) ?></h2>
    <?php $candidates = \app\models\Candidate::find()->where(['position_id' => $position->id])->all(); ?>
    <?php foreach ($candidates as $candidate) : ?>
        <div class="form-group">
            <?= \yii\helpers\Html::radio('candidate_id[' . $position->id . ']', false, ['value' => $candidate->id, 'uncheck' => null]) ?>
            <?= \yii\helpers\Html::encode($candidate->name) ?>
        </div>
    <?php endforeach; ?>
<?php endforeach; ?>
<div class="form-group">
    <?= \yii\helpers\Html::submitButton('Cast Vote', ['class' => 'btn btn-primary']) ?>
</div>
<?php \yii\widgets\ActiveForm::end(); ?>