<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Position $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<!-- Begin breadcrumb -->
<nav aria-label="breadcrumb" style="width: 100%;" class="mx-auto">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/position/index">Position</a></li>
        <li class="breadcrumb-item active" aria-current="page"><?= $this->title ?></li>
    </ol>
</nav>

<div class="row position-view">
    <div class="col-md-12 mx-auto">       

        <p class="pt-4">
            <?= Html::a('Update', ['update', 'slug' => $model->slug], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'slug' => $model->slug], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'name',
                'slug',
                'description:ntext',
                [
                    'attribute' => 'created_at',
                    'value' => function ($model) {
                        return Yii::$app->formatter->asDatetime($model->created_at, 'MMMM d, Y h:ia');
                    },
                ],
                [
                    'attribute' => 'updated_at',
                    'value' => function ($model) {
                        return Yii::$app->formatter->asDatetime($model->updated_at, 'MMMM d, Y h:ia');
                    },
                ]
            ],
        ]) ?>
    </div>

</div>