<?php

use app\models\Position;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Positions';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="position-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>

    </p>


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
                                <th>Position</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <!-- <tfoot>
                        <tr>
                            <th>Name</th>
                            <th>Position</th>
                            <th>Office</th>
                            <th>Age</th>
                            <th>Start date</th>
                            <th>Salary</th>
                        </tr>
                    </tfoot> -->
                        <tbody>
                            <?php foreach ($dataProvider->models as $model) : ?>
                                <tr>
                                    <td><?= $model->name ?></td>
                                    <td><?= $model->description ?></td>
                                    <td><?= Html::a('View', ['view', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                                        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
                                        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                                            'class' => 'btn btn-danger',
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this item?',
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


</div>