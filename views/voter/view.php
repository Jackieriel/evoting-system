<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Voter $model */

$this->title = $model->first_name . ' ' . $model->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Voters', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<!-- Begin breadcrumb -->
<?php if (!empty($this->params['breadcrumbs'])) : ?>
    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<?php endif ?>

<div class="voter-view">

    <div class="row">
        <div class="col-md-12">
            <div class="pt-3 pb-2">
                <?= Html::a('Update', ['update', 'username' => $model->username], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'username' => $model->username], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'username',
                    'first_name',
                    'last_name',
                    'email:email',
                    'otp',
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
        <div class="col-md-2">
            <?php echo Html::img('@web/uploads/users/avater.jpg', ['class' => 'img-thumbnail candidate-img']) ?>
        </div>
    </div>



</div>