<?php

use app\models\Position;
use yii\bootstrap5\Breadcrumbs as Bootstrap5Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\model $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'vote', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<?php if (!empty($this->params['breadcrumbs'])) : ?>
    <?= Bootstrap5Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<?php endif ?>

<div class="model-view">

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
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <?php echo Html::img('@web/' . $model->photo, ['class' => 'img-thumbnail model-img']) ?>            
        </div>
    </div>

</div>