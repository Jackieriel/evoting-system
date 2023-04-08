<?php

use app\models\Candidate;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\CandidateSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Candidates';
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- DataTales Example -->
<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">
            <?= Html::a('Add Position', ['create'], ['class' => 'btn btn-success']) ?>
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
                            <th>Photo At</th>
                            <th>Position</th>
                            <th>Registered On</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($dataProvider->models as $model) : ?>
                            <tr>
                                <td><?= $model->name ?></td>
                                <td class="text-center">
                                    <?php echo Html::img('@web/'.$model->photo, ['class' => 'img-thumbnail table-image']) ?>

                                </td>
                                <td><?= $model->position->name ?></td>
                                <td><?= Yii::$app->formatter->asDatetime($model->created_at, 'MMMM d, Y h:ia') ?></td>
                                <td class="text-right"><?= Html::a('View', ['view', 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
                                    <?= Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-success']) ?>
                                    <?= Html::a('Delete', ['delete', 'slug' => $model->slug], [
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