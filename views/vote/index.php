<?php

use app\models\Candidate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Vote';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- New style -->
<div class="row">
    <div class="col-10 offset-1" id="content">
        <div class="row">


            <?php $form = \yii\widgets\ActiveForm::begin([
                'action' => ['vote'],
            ]); ?>
            <?php foreach ($positions as $position) : ?>
                <?php $candidates = \app\models\Candidate::find()->where(['position_id' => $position->id])->all(); ?>

                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">

                                        <h2><?= \yii\helpers\Html::encode($position->name) ?></h2>
                                    </h3>
                                </div>
                                <div class="col-md-2">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-default btn-sm moveup" data-id="24" disabled=""><i class="fas fa-arrow-up"></i> </button>
                                        <button type="button" class="btn btn-default btn-sm movedown" data-id="24"><i class="fas fa-arrow-down"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <p>Select your candidate
                                <span class="float-end">
                                    <button type="button" class="btn btn-success btn-sm btn-flat reset" data-desc="president"><i class="fas fa-sync-alt"></i> Reset</button>
                                </span>
                            </p>
                            <div id="candidate_list">
                                <ul class="list-unstyled">
                                    <li class="mb-3">
                                        <?php foreach ($candidates as $candidate) : ?>
                                            <div class="form-check">

                                                <?= \yii\helpers\Html::radio('candidate_id[' . $position->id . ']', false, ['value' => $candidate->id, 'uncheck' => null, 'class' => 'icheckbox_flat-green']) ?>
                                                <label class="form-check-label">
                                                    <?php echo Html::img('@web/' . $candidate->photo, ['class' => 'img-thumbnail candidate-photo-vote']) ?>
                                                    <span class="cname"><?= \yii\helpers\Html::encode($candidate->name) ?></span>
                                                </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?= \yii\helpers\Html::submitButton('Cast Vote', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php \yii\widgets\ActiveForm::end(); ?>
        </div>
    </div>


</div>


<!-- New style end-->