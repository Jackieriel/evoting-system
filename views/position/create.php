<?php

use yii\bootstrap5\Breadcrumbs;
use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Position $model */

$this->title = 'Add Position';
$this->params['breadcrumbs'][] = ['label' => 'Positions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<!-- Begin breadcrumb -->

<?php if (!empty($this->params['breadcrumbs'])) : ?>
    <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
<?php endif ?>


<div class="position-create">
    <div class="row">
        <div class="col-md-9 pt-3  mx-auto bg-white rounded-3">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>