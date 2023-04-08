<?php

use app\models\Voter;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\VoterSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Voters';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="voters-index card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <?= Html::a('Register Voter', ['create'], ['class' => 'btn btn-success']) ?>
        </h6>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <?php if (empty($dataProvider->models)) : ?>
                <h4 class="text-center">No position added yet.</h4>
            <?php else : ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>                            
                            <th>Registered On</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataProvider->models as $model) : ?>
                            <tr>
                                <td><?= $model->last_name .' '.$model->first_name ?></td>                                                               
                                <td><?= $model->email ?></td>                                                               
                                <td><?= Yii::$app->formatter->asDatetime($model->created_at, 'MMMM d, Y h:ia') ?></td>
                                <td class="text-right"><?= Html::a('View', ['view', 'username' => $model->username], ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a('Update', ['update', 'username' => $model->username], ['class' => 'btn btn-success']) ?>
                                    <?= Html::a('Delete', ['delete', 'username' => $model->username], [
                                        'class' => 'btn btn-danger',
                                        'data' => [
                                            'confirm' => 'Are you sure you want to remove this candidate?',
                                            'method' => 'post',
                                        ],
                                    ]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</div>
