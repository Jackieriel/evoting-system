<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Position $model */

$this->title = 'Update Position: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'slug' => $model->slug]];
$this->params['breadcrumbs'][] = 'Update';
?>

<!-- Begin breadcrumb -->

<?php if (!empty($this->params['breadcrumbs'])) : ?>
    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<?php endif ?>

<div class="position-update">
    <div class="row">
        <div class="col-md-12">
            <h4 class="text-center p-2"><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="col-md-9 pt-3  mx-auto bg-white rounded-3">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>