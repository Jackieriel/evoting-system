<?php

use app\models\Position;
use yii\bootstrap5\Breadcrumbs as Bootstrap5Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Candidate $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Candidates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php if (!empty($this->params['breadcrumbs'])) : ?>
    <?= Bootstrap5Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<?php endif ?>

<div class="candidate-view">



    <div class="rows">
        <div class="col-md-12">
            <div class="pt-3 pb-2">
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to remove this candidate?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center"><?= $model->name ?></h3>
                </div>
                <div class="card-body">
                    <blockquote class="blockquote mb-0">
                        <p><?= $model->bio ?></p>
                    </blockquote>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><span class="text-primary">Position: </span><?= $model->position->name ?></li>
                    <li class="list-group-item"><span class="text-primary">Registered On: </span>
                        <?= Yii::$app->formatter->asDatetime($model->created_at, 'MMMM d, Y h:ia'); ?>
                    </li>
                    <li class="list-group-item"><span class="text-primary">Updated At: </span>
                        <?= Yii::$app->formatter->asDatetime($model->updated_at, 'MMMM d, Y h:ia'); ?>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <?php echo Html::img('@web/' . $model->photo, ['class' => 'img-thumbnail']) ?>            
        </div>
    </div>


    <!-- <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'name',
                    'photo',
                    'bio:ntext',
                    'position_id',
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
            ]) ?> -->

</div>