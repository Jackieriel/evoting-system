<?php

use app\models\Candidate;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Vote';
$this->params['breadcrumbs'][] = $this->title; ?>

<!-- New style -->
<div class="row">
    <div class="col-10 offset-1" id="content">
        <div class="row">
            <!-- Assuming $results is an array containing the vote results for each position -->
            <!-- Assuming $positions is an array containing the positions -->
            <?php foreach ($positions as $position) : ?>

                <div class="col-12 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-10">
                                    <h3 class="card-title">
                                        <?= \yii\helpers\Html::encode($position->name) ?>
                                    </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 card-body">
                            <div id="candidate_list">
                                <ul class="list-unstyled">
                                    <li class="row mb-3">
                                        <!-- Loop through each candidate's vote results for the current position -->
                                        <?php foreach ($results[$position->id] as $vote) : ?>
                                            <?php $candidate = Candidate::findOne($vote['candidate_id']) ?>
                                            <div class="col-md-3 mx-auto text-center form-check">
                                                <label class="form-check-label">
                                                    <?php echo Html::img('@web/' . $candidate->photo, ['class'
                                                    => 'img-thumbnail candidate-photo-vote mb-2']) ?>
                                                    <div class="text-center">
                                                        <div class="cname">
                                                            <?= $candidate->name ?>
                                                        </div>
                                                        <div class="btn btn-outline-primary btn-result text-center">
                                                            <?= $vote['total_votes']; ?>
                                                        </div>
                                                    </div>
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
    </div>
</div>